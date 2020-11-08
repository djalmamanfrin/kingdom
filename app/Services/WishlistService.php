<?php

namespace App\Services;

use App\Models\Wishlist;
use App\Models\User;

class WishlistService extends AbstractService implements WishlistServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Wishlist());
    }

    public function setPrimaryKeys(array $ids): WishlistService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): WishlistService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Wishlist
    {
        /** @var Wishlist $wishlist */
        $wishlist = parent::get();
        return $wishlist;
    }

    public function store()
    {
        $fill = $this->getFillable();
        User::query()->findOrFail($fill['user_id']);
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('user_id', $fill)) {
            User::query()->findOrFail($fill['user_id']);
        }
        $this->get()->update($fill);
    }
}
