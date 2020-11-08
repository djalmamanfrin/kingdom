<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface NotificationServiceInterface
{
    public function setPrimaryKey(int $id): NotificationService;
    public function setPrimaryKeys(array $ids): NotificationService;
    public function setFillable(array $params);
    public function get(): Notification;
    public function all(): LengthAwarePaginator;
    public function store();
    public function update();
    public function delete();
}
