<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

class ElasticsearchQuery
{
    protected $client;
    protected $results;
    protected $totalRecords;

    public function __construct(ElasticsearchApi $client)
    {
        $this->client = $client; //we need to be able to search agianst elasticsearch
    }

    public function search($term, array $filters = [])
    {
        //build body with term
        $this->buildQuery($term, $filters);
        $response = $this->client->search($index, $indexes, $body);
        // append the wheel data to the results
        $this->results = $response['hits']['hits'];
        //$this->aggregations = $this->applyAggregationSelections(collect($response['aggregations']));
        $this->totalRecords = $response['hits']['total'];
    }

    protected function buildQuery($term, array $filters)
    {
        $body['query']['bool']['must'] = [
            'multi_match' => [
                'query' => $term,
                'type' => 'best_fields',
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

    public function where()
    {

    }

    public function paginate($perPage = 10)
    {
        return new LengthAwarePaginator($this->results, $this->totalRecords, $perPage, $this->getCurrentPage());
    }

    protected function getCurrentPage()
    {
        return request()->input('page', 1);
    }
}