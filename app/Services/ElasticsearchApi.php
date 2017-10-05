<?php

namespace App\Services;

use Elasticsearch\Client as ElasticsearchClient;
use App\Models\Contracts\IndexableEntityInterface as IndexableEntity;

class ElasticsearchApi
{
    private $client;

    public function __construct(ElasticsearchClient $client)
    {
        $this->client = $client;
    }

    public function index(IndexableEntity $entity)
    {
        $response = $this->client->index([
            'index' => $entity->getElasticsearchIndex(),
            'type' => $entity->getElasticsearchType(),
            'id' => $entity->guid,
            'body' => $entity->toElasticsearchArray()
        ]);

        return $response;
    }

    public function updateViews(IndexableEntity $entity)
    {
        $response = $this->client->update([
            'index' => $entity->getElasticsearchIndex(),
            'type' => $entity->getElasticsearchType(),
            'id' => $entity->guid,
            'body' => [
                'script' => 'ctx._source.views = ' . $entity->getTotalViews(),
                'upsert' => [
                    'views' => 0
                ]
            ]
        ]);

        return $response;
    }

    public function delete(IndexableEntity $entity)
    {
        $response = $this->client->delete([
            'index' => $entity->getElasticsearchIndex(),
            'type' => $entity->getElasticsearchType(),
            'id' => $entity->guid,
        ]);

        return $response;
    }

    public function getSource($id, $index, $type)
    {
        $response = $this->client->getSource([
            'id' => $id,
            'index' => $index,
            'type' => $type
        ]);

        return $response;
    }

    public function search($index, $type, $body)
    {
        $response = $this->client->search([
            'index' => $index,
            'type' => $type,
            'body' => $body
        ]);

        return $response;
    }

    public function getClient()
    {
        return $this->client;
    }
}