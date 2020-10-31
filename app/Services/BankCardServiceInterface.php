<?php

namespace App\Services;

use App\Models\BankCard;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BankCardServiceInterface
{
    public function setPrimaryKey(int $id): BankCardService;
    public function setPrimaryKeys(array $ids): BankCardService;
    public function get(): BankCard;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
