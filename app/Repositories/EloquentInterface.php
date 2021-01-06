<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

interface EloquentInterface
{
    // Return an array with ordination setted
    public function getOrder(): array;

    // Set and merge a ordination
    public function setOrder(array $order) : EloquentInterface;

    // Return the page setted
    public function getPage() : int;

    // Set the page number for pagination
    public function setPage(int $page) : EloquentInterface;

    // Return the limit setted
    public function getLimit() : int;

    // Set the limit per page for pagination
    public function setLimit(int $limit) : EloquentInterface;

    // Calculate and return the offset for pagination
    public function getOffset() : int;

    // Return the entity for the give ID
    public function find(int $id) : stdClass;

    // Return the entity for the give ID or throw an exception
    public function findOrFail(int $id) : stdClass;

    // Return a collection with latest 1000 registers
    public function findAll() : LengthAwarePaginator;

    // Return a collection with arguments defined
    public function findBy(array ...$args) : LengthAwarePaginator;

    // Return the first occurrence founded with arguments defined
    public function findOneBy(array ...$args);

    // Create a resource with params
    public function create(array $params);

    // Update a resource with params
    public function update($id, array $params) : bool;

    // Update a resource or create if not exists
    public function updateOrCreate(array $condition, array $params);

    // Delete a resource
    public function delete($id) : bool;

    // Return a stdClass object
    public function fromObject($entity);

    // Make Paginator for collection query
    public function paginator(array $items, int $total = null) : LengthAwarePaginator;

    // Check if a resource exist with params
    public function has(array $params) : bool;
}
