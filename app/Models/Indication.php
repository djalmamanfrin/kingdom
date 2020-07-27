<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indication extends Model
{
    protected $table = 'indication';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'user_type_id', 'name', 'email', 'type'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function indicationType()
    {
        return $this->hasOne('App\UserType', 'user_type_id');
    }
}
