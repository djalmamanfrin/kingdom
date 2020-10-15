<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Branch;
use App\Models\Church;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface ChurchServiceInterface
{
    public function setPrimaryKey(int $id): ChurchService;
    public function setPrimaryKeys(array $ids): ChurchService;
    public function setFillable(Request $request);
    public function get(): Church;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
