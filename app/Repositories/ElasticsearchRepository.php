<?php

namespace App\Repositories;

use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ElasticsearchRepository implements ElasticInterface
{
    private Client $elastic;

    public function __construct(Client $client)
    {
        $this->elastic = $client;
    }

    public function search(Model $model, string $term, int $page, int $perPage): LengthAwarePaginator
    {
        $body = [
            'index' => $model->getElasticsearchIndex(),
            'from' => $page,
            'size' => $perPage,
            'body'  => [
                'query' => [
                    'multi_match' => [
                        'fields' => $model->getFields(),
                        'query' => $term,
                        "type" => "phrase_prefix"
                    ]
                ]
            ]
        ];
        $items = $this->elastic->search($body);
        $total = (int) $items['hits']['total']['value'];
        $items = collect($items['hits']['hits'])->pluck('_source');
        return paginate($items, $total, $perPage, $page);
    }
}
