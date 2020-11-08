<?php

namespace App\Services;

use App\Models\City;
use App\Models\State;

class CityService extends AbstractService implements CityServiceInterface
{
    public function __construct()
    {
        parent::__construct(new City());
    }

    public function setPrimaryKeys(array $ids): CityService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): CityService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): City
    {
        /** @var City $city */
        $city = parent::get();
        return $city;
    }

    public function store()
    {
        $fill = $this->getFillable();
        State::query()->findOrFail($fill['state_id']);
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('state_id', $fill)) {
            State::query()->findOrFail($fill['state_id']);
        }
        $this->get()->update($fill);
    }
}
