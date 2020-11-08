<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface ProjectServiceInterface
{
    public function setPrimaryKey(int $id): ProjectService;
    public function setPrimaryKeys(array $ids): ProjectService;
    public function setFillable(array $params);
    public function get(): Project;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
