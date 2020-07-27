<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'user_type';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_id');
    }

    public function indicators()
    {
        return $this->belongsToMany('App\Indication', 'indication_id');
    }
}
