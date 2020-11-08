<?php

namespace App\Services;

use App\Models\City;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CityServiceInterface
{
    public function setPrimaryKey(int $id): CityService;
    public function setPrimaryKeys(array $ids): CityService;
    public function setFillable(array $params);
    public function get(): City;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
