<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

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
        /** @var Product $project */
        $project = parent::get();
        return $project;
    }

    public function store()
    {
        $fill = $this->getFillable();
        User::query()->findOrFail($fill['user_id']);
        Category::query()->findOrFail($fill['category_id']);
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('user_id', $fill)) {
            User::query()->findOrFail($fill['user_id']);
        }
        if (array_key_exists('category_id', $fill)) {
            Category::query()->findOrFail($fill['category_id']);
        }
        $this->get()->update($fill);
    }

    /**
     * @throws Exception
     */
    public function delete()
    {
        try {
            DB::beginTransaction();
            $this->get()->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new InvalidArgumentException('Error to delete project: ' . $e->getMessage(), 422);
        }
    }
}
