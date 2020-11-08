<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ServiceServiceInterface
{
    public function setPrimaryKey(int $id): ServiceService;
    public function setPrimaryKeys(array $ids): ServiceService;
    public function setFillable(array $params);
    public function get(): Service;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
