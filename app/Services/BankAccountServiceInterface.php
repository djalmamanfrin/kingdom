<?php

namespace App\Services;

use App\Models\BankAccount;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface BankAccountServiceInterface
{
    public function setPrimaryKey(int $id): BankAccountService;
    public function setPrimaryKeys(array $ids): BankAccountService;
    public function setFillable(array $params);
    public function get(): BankAccount;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
