<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'notification_id', 'type', 'title', 'description', 'is_read'];

    public function user(): User
    {
        return $this->belongsTo(User::class)->get()->first();
    }

    public function notificationType(): NotificationType
    {
        return $this->hasOne(NotificationType::class)->get()->first();
    }
}
