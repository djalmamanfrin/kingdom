<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Company;
use App\Models\Service;
use App\Models\User;

class ServiceService extends AbstractService implements ServiceServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Service());
    }

    public function setPrimaryKeys(array $ids): ServiceService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): ServiceService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Service
    {
        /** @var Service $service */
        $service = parent::get();
        return $service;
    }

    public function store()
    {
        $fill = $this->getFillable();
        Company::query()->findOrFail($fill['company_id']);
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('category_id', $fill)) {
            Company::query()->findOrFail($fill['company_id']);
        }
        $this->get()->update($fill);
    }
}
