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

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function notificationType()
    {
        return $this->hasOne('App\NotificationType', 'notification_type_id');
    }
}
