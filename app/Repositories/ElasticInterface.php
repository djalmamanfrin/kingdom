<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ElasticInterface
{
    public function search(Model $model, string $term, int $page, int $perPage): LengthAwarePaginator;
}
