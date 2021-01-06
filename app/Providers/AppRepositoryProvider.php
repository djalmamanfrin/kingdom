<?php

namespace App\Providers;

use App\Repositories\ElasticInterface;
use App\Repositories\ElasticsearchRepository;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ElasticInterface::class, ElasticsearchRepository::class);
        $this->app->bind(Client::class, function () {
            return ClientBuilder::create()
                ->setHosts(config('services.search.hosts'))
                ->build();
        });
    }
}
