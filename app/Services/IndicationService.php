<?php

namespace App\Services;

use App\Models\Indication;
use App\Models\User;

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
        /** @var Indication $indication */
        $indication = parent::get();
        return $indication;
    }

    public function store()
    {
        $fill = $this->getFillable();
        User::query()->findOrFail($fill['user_id']);
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('user_id', $fill)) {
            User::query()->findOrFail($fill['user_id']);
        }
        $this->get()->update($fill);
    }
}
