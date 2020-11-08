<?php

namespace App\Services;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\User;

class StateService extends AbstractService implements StateServiceInterface
{
    public function __construct()
    {
        parent::__construct(new State());
    }

    public function setPrimaryKeys(array $ids): StateService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): StateService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): State
    {
        /** @var State $state */
        $state = parent::get();
        return $state;
    }

    public function store()
    {
        $fill = $this->getFillable();
        Country::query()->findOrFail($fill['country_id']);
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('country_id', $fill)) {
            Country::query()->findOrFail($fill['country_id']);
        }
        $this->get()->update($fill);
    }
}
