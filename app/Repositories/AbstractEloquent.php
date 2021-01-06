<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

abstract class AbstractEloquent implements EloquentInterface
{
    protected array $order = [];
    protected int $limit = 1000;
    protected int $page = 1;
    protected Model $model;

    abstract public function getModelClassName(): string;

    public function getOrder(): array
    {
        return empty($this->order) ? [[$this->getModel()->getKeyName(), 'DESC']] : $this->order;
    }

    public function setOrder(array $order): AbstractEloquent
    {
        $this->order = array_merge($this->order, $order);
        return $this;
    }

    public function getPage() : int
    {
        return $this->page;
    }

    public function setPage(int $page) : AbstractEloquent
    {
        $this->page = $page;
        return $this;
    }

    public function getLimit() : int
    {
        return $this->limit;
    }

    public function setLimit(int $limit) : AbstractEloquent
    {
        $this->limit = $limit;
        return $this;
    }

    public function getOffset() : int
    {
        return $this->page === 1 ? 0 : ($this->page * $this->limit);
    }

    protected function getModel()
    {
        return app($this->getModelClassName());
    }

    public function find(int $id) : stdClass
    {
        return $this->getModel()->find($id);
    }

    public function findOrFail(int $id) : stdClass
    {
        return $this->getModel()->findOrFail($id);
    }

    public function findAll() : LengthAwarePaginator
    {
        $builder = $this->getModel();
        foreach ($this->getOrder() as $order) {
            $builder = $builder->orderBy($order[0], $order[1]);
        }
        return $builder->paginate($this->limit);
    }

    public function findBy(array ...$args) : LengthAwarePaginator
    {
        $builder = $this->getModel();
        foreach ($args as $arg) {
            $builder = $builder->where($arg[0], $arg[1], $arg[2]);
        }
        foreach ($this->getOrder() as $order) {
            $builder = $builder->orderBy($order[0], $order[1]);
        }
        return $builder->paginate($this->limit);
    }

    public function findOneBy(array ...$args)
    {
        $entity = $this->findBy(...$args);
        if (! $entity->count()) {
            throw new Exception("None has been founded.", 404);
        }
        return $entity->first();
    }

    public function create(array $params)
    {
        return $this->getModel()->create($params);
    }

    public function update($id, array $params) : bool
    {
        return (bool) $this->findOrFail($id)->update($params);
    }

    public function updateOrCreate(array $condition, array $params)
    {
        return $this->getModel()->updateOrCreate($condition, $params);
    }

    public function delete($id) : bool
    {
        return (bool) $this->getModel()->findOrFail($id)->delete();
    }

    public function fromObject($entity)
    {
        return array_switch([
            'string' => ! is_string($entity) ?: json_decode($entity),
            'array' => (object) $entity,
            'object' => method_exists($entity, 'toArray') ? (object) $entity->toArray() : $entity,
            'NULL' => new stdClass
        ], gettype($entity));
    }

    public function paginator(array $items, int $total = null) : LengthAwarePaginator
    {
        $total ??= $this->getModel()->count();
        $paginator = new LengthAwarePaginator(
            collect($items),
            $total,
            $this->limit,
            $this->page
        );

        if ($paginator->lastPage() < $paginator->currentPage()) {
            throw new Exception("Out of bounds, check the limit page", Response::HTTP_NOT_ACCEPTABLE);
        }
        return $paginator;
    }

    public function has(array $params) : bool
    {
        return (bool) $this->findOneBy($params);
    }
}
