<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\Branch;
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
        if (! array_key_exists('user_id', $fill)) {
            $message = 'The user_id field must be informed to verify if the user exists';
            throw new InvalidArgumentException($message, 422);
        }
        User::query()->findOrFail($fill['user_id']);

        if (! array_key_exists('bank_id', $fill)) {
            $message = 'The bank_id field must be informed to verify if the bank exists';
            throw new InvalidArgumentException($message, 422);
        }
        User::query()->findOrFail($fill['bank_id']);

        if (! array_key_exists('document', $fill)) {
            throw new InvalidArgumentException('The document field must be informed', 422);
        }
        $this->isStored('document', $fill['document']);

        if (! array_key_exists('agency', $fill)) {
            throw new InvalidArgumentException('The agency field must be informed', 422);
        }
        if (! array_key_exists('account', $fill)) {
            throw new InvalidArgumentException('The account field must be informed', 422);
        }
        if (! array_key_exists('type', $fill)) {
            throw new InvalidArgumentException('The type field must be informed', 422);
        }
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('branch_id', $fill)) {
            Branch::query()->findOrFail($fill['branch_id']);
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
            throw new InvalidArgumentException('Error to delete project: ' . $e->getMessage(), 422);
        }
    }
}
