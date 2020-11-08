<?php

namespace App\Services;

use App\Models\Wishlist;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface WishlistServiceInterface
{
    public function setPrimaryKey(int $id): WishlistService;
    public function setPrimaryKeys(array $ids): WishlistService;
    public function setFillable(array $params);
    public function get(): Wishlist;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
