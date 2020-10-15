<?php

namespace App\Services;

use App\Models\Branch;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface BranchServiceInterface
{
    public function setPrimaryKey(int $id): BranchService;
    public function setPrimaryKeys(array $ids): BranchService;
    public function setFillable(Request $request);
    public function get(): Branch;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
