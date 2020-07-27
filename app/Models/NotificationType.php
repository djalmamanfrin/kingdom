<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    protected $table = 'notification_type';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['name', 'description'];

    public function notifications()
    {
        return $this->belongsToMany('App\Notification', 'notification_id');
    }
}
