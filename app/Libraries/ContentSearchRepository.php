<?php

namespace App\Repositories;

use App\Models\Entities\Category;
use App\Services\ElasticsearchApi;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class ContentSearchRepository
{
    protected $itemsPerPage;
    protected $totalRecords;
    protected $aggregations;
    protected $results;
    protected $paginator;
    protected $categories;
    protected $archived = false;

    protected $filters = [
        'types',
        'speakers',
        'categories',
        'memberships',
        'species',
        'series',
        'areas'
    ];

    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    public function getSearchResults($itemsPerPage = 10, $indexes = 'webinar,course,event')
    {
        $body = $this->buildSearchCriteria($itemsPerPage);
        $this->performSearch($body, $indexes);

        return [
            'results'      => $this->getResults(),
            'total'        => $this->getTotalRecords(),
            'aggregations' => $this->getAggregations(),
            'paginator' => $this->getPaginator(),
        ];
    }

    protected function buildSearchCriteria($itemsPerPage = 10)
    {
        $this->itemsPerPage = $itemsPerPage;
        $body = $this->buildQueryBody();

        return $body;
    }

    protected function performSearch($body, $indexes)
    {
        $response = app(ElasticsearchApi::class)->search('webinars', $indexes, $body);
        // append the wheel data to the results
        $this->results = $this->appendWheelData($response['hits']['hits']);
        $this->aggregations = $this->applyAggregationSelections(collect($response['aggregations']));
        $this->totalRecords = $response['hits']['total'];
        $this->paginator = new LengthAwarePaginator($this->results, $this->totalRecords, $this->itemsPerPage, $this->getCurrentPage());
    }

    public function getResults()
    {
        return $this->results;
    }

    protected function buildQueryBody()
    {
        $offset = $this->itemsPerPage * ($this->getCurrentPage() - 1);
        $body = [
            'size' => $this->itemsPerPage,
            'from' => $offset,
        ];
        $body['sort'] = [
            'scheduled_at' => [
                'order' => 'desc'
            ]
        ];
        $body = $this->applyFilters($body);
        $body = $this->applyAggregations($body);

        return $body;
    }

    /**
     * Apply search filter if user types a query or selects a facet type
     *
     * @param $body
     * @return mixed
     */
    protected function applyFilters($body)
    {
        // did they enter a general query?
        if (request()->has('query')) {
            $body['query']['bool']['must'] = [
                'multi_match' => [
                    'query' => request()->get('query'),
                    'type' => 'phrase_prefix',
                    'fields' => [
                        'name',
                        'synopsis',
                        'speakers',
                        'sponsors',
                        'keypoints'
                    ],
                    'operator' => 'and'
                ]
            ];
        }
        if($this->archived)
        {
            $body['query']['bool']['filter']['range']['scheduled_at']['lte'] = Carbon::now()->toAtomString();
        }

        // build array of facet (aggregation) filters
        $terms = array_values(collect($this->filters)->filter(function ($filter) {
            return request()->has($filter);
        })->map(function ($filter) {
            // types is an Elastic specific field in the index
            if ($filter === 'types') {
                return ['match' => ['_type' => strtolower(request()->get($filter))]];
            }

            return ['match' => [$filter => strtolower(request()->get($filter))]];
        })->toArray());
        // if facet filters were used, apply them to the query
        if (count($terms) > 0) {
            $body['query']['bool']['filter'] = [
                'bool' => [
                    'must' => [
                        $terms
                    ]
                ]
            ];
        }

        return $body;
    }

    public function archivedContentOnly()
    {
        $this->archived = true;

        return $this;
    }
    /**
     * Request the following aggregations for the results
     *
     * @param $body
     * @return mixed
     */
    protected function applyAggregations($body)
    {
        $body['aggs'] = [
            'species' => [
                'terms' => [
                    'field' => 'species.keyword'
                ]
            ],
            'areas' => [
                'terms' => [
                    'field' => 'areas.keyword'
                ]
            ],
            'series' => [
                'terms' => [
                    'field' => 'series.keyword'
                ]
            ],
            'categories' => [
                'terms' => [
                    'field' => 'categories.keyword'
                ]
            ],
            'memberships' => [
                'terms' => [
                    'field' => 'memberships.keyword'
                ]
            ],
            'speakers' => [
                'terms' => [
                    'field' => 'speakers.keyword'
                ]
            ],
            'types' => [
                'terms' => [
                    'field' => '_type'
                ]
            ]
        ];

        return $body;
    }

    /**
     * If a user has filtered on an aggregation type, only show the item selected
     *
     * @param $aggregations
     * @return mixed
     */
    protected function applyAggregationSelections($aggregations)
    {
        return $aggregations->map(function ($data, $name) {
            if (in_array($name, array_keys(request()->all()))) {
                $data['buckets'] = collect($data['buckets'])->filter(function ($item) use($name) {
                    return $item['key'] == request()->get($name);
                });
            }
            return $data;
        });
    }

    protected function getCategoryColourByName($name)
    {
        return $this->categories->pluck('colour', 'name')->toArray()[$name];
    }

    /**
     * Build the Cpd wheel data structure so the wheel can
     * be renedered in the search results
     *
     * @param $source
     * @return mixed|string|void
     */
    protected function getWheelData($source)
    {
        $data = [];
        $data['labels'] = [];
        $data['data'] = [];
        $data['colours'] = [];

        if (count($source['category_minutes']) > 0) {
            foreach ($source['category_minutes'] as $category) {
                $data['labels'][] = $category['name'];
                $data['data'][] = $category['minutes'];
                $data['colours'][] = $this->getCategoryColourByName($category['name']);
            }
        }

        return json_encode($data);
    }

    /**
     * The search results will have some CPD related data which will need
     * processing and appending to each result.
     *
     * @param $results
     * @return static
     */
    protected function appendWheelData($results)
    {
        $results = collect($results)->map(function ($result) {
            if ($result['_type'] == 'webinar' || $result['_type'] == 'course') {
                $result['lengthInHours'] = convertMinutesToHoursFormat($result['_source']['length']);
                $result['wheelData'] = $this->getWheelData($result['_source']);
            }

            return $result;
        });

        return $results;
    }

    public function getAggregations()
    {
        return $this->aggregations;
    }

    public function getPaginator()
    {
        return $this->paginator;
    }

    public function getCurrentPage()
    {
        return request()->input('page', 1);
    }

    public function getTotalRecords()
    {
        return $this->totalRecords;
    }
}