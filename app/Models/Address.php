<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'city_id', 'street', 'number', 'zipcode'];

    public function user()
    {
        return $this->hasOne('App\User', 'user_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }
}
