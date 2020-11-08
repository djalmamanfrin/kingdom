<?php

namespace App\Services;

use App\Models\Address;
use App\Models\City;
use App\Models\User;

class AddressService extends AbstractService implements AddressServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Address());
    }

    public function setPrimaryKeys(array $ids): AddressService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): AddressService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Address
    {
        /** @var Address $address */
        $address = parent::get();
        return $address;
    }

    public function store()
    {
        $fill = $this->getFillable();
        User::query()->findOrFail($fill['user_id']);
        City::query()->findOrFail($fill['city_id']);
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('user_id', $fill)) {
            User::query()->findOrFail($fill['user_id']);
        }
        if (array_key_exists('city_id', $fill)) {
            City::query()->findOrFail($fill['city_id']);
        }
        $this->get()->update($fill);
    }
}
