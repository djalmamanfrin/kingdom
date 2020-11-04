<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\Branch;
use App\Models\Indication;
use App\Models\Notification;
use App\Models\Member;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class IndicationService extends AbstractService implements IndicationServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Indication());
    }

    public function setPrimaryKeys(array $ids): IndicationService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): IndicationService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Indication
    {
        /** @var Indication $project */
        $project = parent::get();
        return $project;
    }

    public function store()
    {
        $fill = $this->getFillable();
        User::query()->findOrFail($fill['user_id']);
        Member::query()->findOrFail($fill['profile_id']);
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('user_id', $fill)) {
            User::query()->findOrFail($fill['user_id']);
        }
        if (array_key_exists('profile_id', $fill)) {
            Notification::query()->findOrFail($fill['profile_id']);
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
            throw new InvalidArgumentException('Error to delete indication: ' . $e->getMessage(), 422);
        }
    }
}
