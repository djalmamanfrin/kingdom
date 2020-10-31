<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class BankAccountService extends AbstractService implements BankAccountServiceInterface
{
    public function __construct()
    {
        parent::__construct(new BankAccount());
    }

    public function setPrimaryKeys(array $ids): BankAccountService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): BankAccountService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): BankAccount
    {
        /** @var BankAccount $project */
        $project = parent::get();
        return $project;
    }

    public function store()
    {
        $fill = $this->getFillable();
        User::query()->findOrFail($fill['user_id']);
        BankAccount::query()->findOrFail($fill['bank_id']);
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('user_id', $fill)) {
            User::query()->findOrFail($fill['user_id']);
        }
        if (array_key_exists('bank_id', $fill)) {
            Bank::query()->findOrFail($fill['bank_id']);
        }
        $this->get()->update($fill);
    }

    /**
     * @throws Exception
     */
    public function delete()
    {
        try {
            DB::beginTransaction();
            $this->get()->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new InvalidArgumentException('Error to delete back_account: ' . $e->getMessage(), 422);
        }
    }
}
