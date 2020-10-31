<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface ProfileServiceInterface
{
    public function setPrimaryKey(int $id): ProfileService;
    public function setPrimaryKeys(array $ids): ProfileService;
    public function setFillable(array $params);
    public function get(): Profile;
    public function all(): LengthAwarePaginator;
    public function isResponsible();
}
