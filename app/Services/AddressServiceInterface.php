<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AddressServiceInterface
{
    public function setPrimaryKey(int $id): AddressService;
    public function setPrimaryKeys(array $ids): AddressService;
    public function setFillable(array $params);
    public function get(): Address;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
