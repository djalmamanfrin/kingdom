<?php

namespace App\Services;

use App\Models\Indication;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IndicationServiceInterface
{
    public function setPrimaryKey(int $id): IndicationService;
    public function setPrimaryKeys(array $ids): IndicationService;
    public function setFillable(array $params);
    public function get(): Indication;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
