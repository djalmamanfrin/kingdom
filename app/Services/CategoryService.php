<?php

namespace App\Services;

use App\Models\Category;

class CategoryService extends AbstractService implements CategoryServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Category());
    }

    public function setPrimaryKeys(array $ids): CategoryService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): CategoryService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Category
    {
        /** @var Category $category */
        $category = parent::get();
        return $category;
    }
}
