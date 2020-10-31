<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public function setPrimaryKey(int $id): UserService;
    public function setPrimaryKeys(array $ids): UserService;
    public function get(): User;
    public function setFillable(array $params);
    public function store();
    public function update();
    public function all(): LengthAwarePaginator;
}
