<?php

namespace App\Services;

use App\Models\Phone;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PhoneServiceInterface
{
    public function setPrimaryKey(int $id): PhoneService;
    public function setPrimaryKeys(array $ids): PhoneService;
    public function setFillable(array $params);
    public function get(): Phone;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
