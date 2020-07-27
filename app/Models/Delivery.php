<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'delivery';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['order_id', 'address_id', 'description', 'date'];

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }

    public function address()
    {
        return $this->hasOne('App\Address', 'address_id');
    }
}
