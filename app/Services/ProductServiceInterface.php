<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductServiceInterface
{
    public function setPrimaryKey(int $id): ProductService;
    public function setPrimaryKeys(array $ids): ProductService;
    public function setFillable(array $params);
    public function get(): Product;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
