<?php

namespace App\Services;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

abstract class AbstractService
{
    protected array $primaryKeys;
    protected Model $model;
    protected string $modelName;

    public function __construct(Model $model)
    {
        $this->primaryKeys = [];
        $this->model = $model;
        $this->modelName = str_replace('_' , ' ', $this->model->getTable());
    }

    protected function setPrimaryKey(int $id)
    {
        $this->primaryKeys = [$id];
    }

    protected function setPrimaryKeys(array $ids)
    {
        $this->primaryKeys = $ids;
    }

    protected function isPrimaryKeyEmpty()
    {
        if (empty($this->primaryKeys)) {
            throw new InvalidArgumentException('You must inform at least one primary key', 422);
        }
    }

    public function setFillable(array $params)
    {
        $this->model->fillable($params);
    }

    protected function getFillable(): array
    {
        $fillable = $this->model->getFillable();
        if (empty($fillable)) {
            throw new InvalidArgumentException('Fillable empty', 400);
        }
        return $fillable;
    }

    protected function get(): Model
    {
        $this->isPrimaryKeyEmpty();
        try {
            $id = current($this->primaryKeys);
            return $this->model->newQuery()->where('id', $id)->firstOrFail();
        } catch (Exception $e) {
            throw new InvalidArgumentException("The " . $this->modelName . " not found", 422);
        }
    }

    protected function isStored(string $column, string $value, $message = null)
    {
        $isStored = $this->model->newQuery()->where($column, $value)->exists();
        $errorMessage = is_null($message) ? ucfirst($column) . ' already stored' : $message;
        if ($isStored) {
            throw new InvalidArgumentException($errorMessage, 422);
        }
    }

    public function store()
    {
        $fill = $this->getFillable();
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
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
            $errorMessage = 'Error to delete' . $this->modelName . ': ' . $e->getMessage();
            throw new InvalidArgumentException($errorMessage, 422);
        }
    }

    public function all(): LengthAwarePaginator
    {
        $query = $this->model->newQuery();
        if (! empty($this->primaryKeys)) {
            $query->whereIn('id', $this->primaryKeys);
        }
        return $query->paginate(15);
    }
}
