<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService extends AbstractService implements NotificationServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Notification());
    }

    public function setPrimaryKeys(array $ids): NotificationService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): NotificationService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Notification
    {
        /** @var Notification $notification */
        $notification = parent::get();
        return $notification;
    }

    public function store()
    {
        $fill = $this->getFillable();
        User::query()->findOrFail($fill['user_id']);
        Notification::query()->findOrFail($fill['notification_type_id']);
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('user_id', $fill)) {
            User::query()->findOrFail($fill['user_id']);
        }
        if (array_key_exists('notification_type_id', $fill)) {
            Notification::query()->findOrFail($fill['notification_type_id']);
        }
        $this->get()->update($fill);
    }
}
