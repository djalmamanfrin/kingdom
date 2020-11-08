<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Phone;
use App\Models\User;

class PhoneService extends AbstractService implements PhoneServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Phone());
    }

    public function setPrimaryKeys(array $ids): PhoneService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): PhoneService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Phone
    {
        /** @var Phone $phone */
        $phone = parent::get();
        return $phone;
    }

    public function store()
    {
        $fill = $this->getFillable();
        User::query()->findOrFail($fill['user_id']);
        Country::query()->findOrFail($fill['country_id']);
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('user_id', $fill)) {
            User::query()->findOrFail($fill['user_id']);
        }
        if (array_key_exists('country_id', $fill)) {
            Country::query()->findOrFail($fill['country_id']);
        }
        $this->get()->update($fill);
    }
}
