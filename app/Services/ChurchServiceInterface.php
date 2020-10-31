<?php

namespace App\Services;

use App\Models\Church;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ChurchServiceInterface
{
    public function setPrimaryKey(int $id): ChurchService;
    public function setPrimaryKeys(array $ids): ChurchService;
    public function setFillable(array $params);
    public function get(): Church;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
