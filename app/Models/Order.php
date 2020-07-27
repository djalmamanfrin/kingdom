<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'uuid'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function items()
    {
        return $this->hasMany('App\Item', 'item_id');
    }
}
