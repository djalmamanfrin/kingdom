<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

abstract class AbstractService
{
    protected array $primaryKeys;
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->primaryKeys = [];
        $this->model = $model;
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

    public function setFillable(Request $request)
    {
        $config = $request->route()[1]['validate'] ?? null;
        if (is_null($config)) {
            throw new InvalidArgumentException('Config validate_field requested but validate field not found');
        }
        $fields = config("validate_middleware.$config.fields");
        $messages = config("validate_middleware.$config.messages");
        if (! is_array($fields) || ! is_array($messages)) {
            throw new InvalidArgumentException('Validate field config not found or not implemented');
        }

        // Validate just fields requested if method not POST
        $requestFields = $request->all();
        $fieldsToValidate = $fields;
        if (! $request->isMethod('POST') && ! $request->isMethod('PUT')) {
            $requestKeys = array_keys($requestFields);
            $requestKeys =  array_flip($requestKeys);
            $fieldsToValidate = array_intersect_key($fields, $requestKeys);
        }
        Validator::make($requestFields, $fieldsToValidate, $messages)->validate();
        $this->model->fillable($request->all());
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
            $model = $this->model->getTable();
            $model =  str_replace('_' , ' ', $model);
            throw new InvalidArgumentException("The $model not found", 422);
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

    public function all(): LengthAwarePaginator
    {
        $query = $this->model->newQuery();
        if (! empty($this->primaryKeys)) {
            $query->whereIn('id', $this->primaryKeys);
        }
        return $query->paginate(15);
    }
}
