<?php

namespace App\Services;

use App\Models\State;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface StateServiceInterface
{
    public function setPrimaryKey(int $id): StateService;
    public function setPrimaryKeys(array $ids): StateService;
    public function setFillable(array $params);
    public function get(): State;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
