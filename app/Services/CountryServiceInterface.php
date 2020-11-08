<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CountryServiceInterface
{
    public function setPrimaryKey(int $id): CountryService;
    public function setPrimaryKeys(array $ids): CountryService;
    public function setFillable(array $params);
    public function get(): Country;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
