<?php

namespace App\Services;

use App\Models\Country;

class CountryService extends AbstractService implements CountryServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Country());
    }

    public function setPrimaryKeys(array $ids): CountryService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): CountryService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Country
    {
        /** @var Country $phone */
        $phone = parent::get();
        return $phone;
    }
}
