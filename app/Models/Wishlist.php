<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'service_id'];

    public function user(): User
    {
        return $this->belongsTo(User::class)->get()->first();
    }

    public function service(): Service
    {
        return $this->belongsTo(Service::class)->get()->first();
    }
}
