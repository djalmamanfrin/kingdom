<?php

namespace App\Services;

use App\Models\BankCard;
use Illuminate\Support\Collection;

class BankCardService extends AbstractService implements BankCardServiceInterface
{
    public function __construct()
    {
        parent::__construct(new BankCard());
    }

    public function setPrimaryKeys(array $ids): BankCardService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): BankCardService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): BankCard
    {
        /** @var BankCard $bankCard */
        $bankCard = parent::get();
        return $bankCard;
    }
}
