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

    public function user(): User
    {
        return $this->hasOne(User::class)->get()->first();
    }

    public function city(): City
    {
        return $this->belongsTo(City::class)->get()->first();
    }

    public function church(): array
    {
        $address = parent::toArray();
        unset($address['user_id']);
        return $address;
    }
}
