<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class BranchService extends AbstractService implements BranchServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Branch());
    }

    public function setPrimaryKeys(array $ids): BranchService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): BranchService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Branch
    {
        /** @var Branch $branch */
        $branch = parent::get();
        return $branch;
    }

    public function store()
    {
        $fill = $this->getFillable();
        User::query()->findOrFail($fill['user_id']);
        $this->isStored('email', $fill['email']);
        $this->model::create($fill);
    }

    public function update()
    {
        $values = $this->getFillable();
        if (array_key_exists('user_id', $values)) {
            $this->get()->user();
        }
        if (array_key_exists('email', $values)) {
            $this->isStored('email', $values['email']);
        }
        $this->get()->update($values);
    }

    /**
     * @throws Exception
     */
    public function delete()
    {
        try {
            DB::beginTransaction();
            $branch = $this->get();
            $branch->churches()->delete();
            $branch->projects()->delete();
            $branch->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new InvalidArgumentException('Error to delete branch: ' . $e->getMessage(), 422);
        }
    }
}
