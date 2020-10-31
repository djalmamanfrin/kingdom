<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryServiceInterface
{
    public function setPrimaryKey(int $id): CategoryService;
    public function setPrimaryKeys(array $ids): CategoryService;
    public function setFillable(array $params);
    public function get(): Category;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
