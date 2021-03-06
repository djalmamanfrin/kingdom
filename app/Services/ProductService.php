<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Product;

class ProductService extends AbstractService implements ProductServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Product());
    }

    public function setPrimaryKeys(array $ids): ProductService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): ProductService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Product
    {
        /** @var Product $product */
        $product = parent::get();
        return $product;
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
        if (array_key_exists('user_id', $fill)) {
            Company::query()->findOrFail($fill['company_id']);
        }
        $this->get()->update($fill);
    }
}
