<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Category;
use App\Models\Company;
use App\Models\Entrepreneur;
use App\Models\User;

class CompanyService extends AbstractService implements CompanyServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Company());
    }

    public function setPrimaryKeys(array $ids): CompanyService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): CompanyService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Company
    {
        /** @var Company $company */
        $company = parent::get();
        return $company;
    }

    public function store()
    {
        $fill = $this->getFillable();
        Entrepreneur::query()->findOrFail($fill['entrepreneur_id']);
        Category::query()->findOrFail($fill['category_id']);
        Address::query()->findOrFail($fill['address_id']);
        $this->isStored('cnpj', $fill['cnpj']);
        $this->model::create($fill);
    }

    public function update()
    {
        $values = $this->getFillable();
        if (array_key_exists('entrepreneur_id', $values)) {
            Entrepreneur::query()->findOrFail($values['entrepreneur_id']);
        }
        if (array_key_exists('category_id', $values)) {
            Category::query()->findOrFail($values['category_id']);
        }
        if (array_key_exists('address_id', $values)) {
            Address::query()->findOrFail($values['address_id']);
        }
        if (array_key_exists('cnpj', $values)) {
            $this->isStored('cnpj', $values['cnpj']);
        }
        $this->get()->update($values);
    }
}
