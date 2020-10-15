<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function setPrimaryKey(int $id): UserService;
    public function setPrimaryKeys(array $ids): UserService;
    public function get(): User;
    public function setFillable(Request $request);
    public function store();
    public function update();
    public function all(): LengthAwarePaginator;
}
