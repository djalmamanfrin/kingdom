<?php

namespace App\Traits;

use App\Observers\ElasticsearchObserver;

trait Searchable
{
    public static function bootSearchable(): void
    {
        // This makes it easy to toggle the search feature flag on and off.
        // This is going to prove useful later on when deploy the new search engine to a live app.
        if (config('services.search.enabled')) {
            static::observe(app(ElasticsearchObserver::class));
        }
    }

    abstract public function getElasticsearchIndex(): string;
    abstract public function getFields(): array;
    abstract public function getData(): array;
}
