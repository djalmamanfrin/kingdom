<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CompanyServiceInterface
{
    public function setPrimaryKey(int $id): CompanyService;
    public function setPrimaryKeys(array $ids): CompanyService;
    public function setFillable(array $params);
    public function get(): Company;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
