<?php

namespace App\Console\Commands;

use Elasticsearch\Client;
use Illuminate\Console\Command;

class CreateServicesIndexInElasticSearch extends Command
{
    /** @var string The console command name */
    protected $signature = "elastic:create-services-index";

    /** @var string The console command description */
    protected $description = "Creation, Setting and Mapping of the service index in Elasticsearch";

    public function handle(Client $elastic)
    {
        $params = [
            'index' => 'services',
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0,
                    'analysis' => [
                        'filter' => [
                            'portuguese_stop' => [
                                'type' => 'stop',
                                'stopwords' => '_portuguese_'
                            ],
                            // 'portuguese_keywords' => [
                            //     'type' => 'keyword_marker',
                            //     'keywords' => ["exemplo"]
                            // ],
                            'portuguese_stemmer' => [
                                'type' => 'stemmer',
                                'language' => "minimal_portuguese"
                            ],
                        ],
                        'analyzer' => [
                            'kingdom' => [
                                'type' => 'custom',
                                'tokenizer' => 'standard',
                                'filter' => ['lowercase', 'asciifolding', 'portuguese_stop', 'portuguese_stemmer']
                            ]
                        ]
                    ]
                ],
                'mappings' => [
                    'properties' => [
                        'name' => [
                            'type' => 'text',
                            'analyzer' => 'kingdom'
                        ],
                        'description' => [
                            'type' => 'text',
                            'analyzer' => 'kingdom'
                        ],
                        'tags' => [
                            'type' => 'text',
                            'analyzer' => 'kingdom'
                        ],
                        'id' => [
                            'type' => 'keyword'
                        ],
                        'company_id' => [
                            'type' => 'keyword'
                        ],
                        'created_at' => [
                            'type' => 'date',
                            'format' => 'yyyy-MM-dd HH:mm:ss'
                        ],
                        'updated_at' => [
                            'type' => 'date',
                            'format' => 'yyyy-MM-dd HH:mm:ss'
                        ]
                    ]
                ]
            ]
        ];
        $response = $elastic->indices()->create($params);
        dd($response);
    }
}
