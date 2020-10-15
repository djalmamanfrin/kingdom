<?php

namespace App\Services;

use App\Models\BankAccount;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface BankAccountServiceInterface
{
    public function setPrimaryKey(int $id): BankAccountService;
    public function setPrimaryKeys(array $ids): BankAccountService;
    public function setFillable(Request $request);
    public function get(): BankAccount;
    public function all(): LengthAwarePaginator;
}
