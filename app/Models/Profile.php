<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    const CLIENT = 1;
    const SELLER = 2;
    const RESPONSIBLE = 3;

    protected $table = 'profile';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['name', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function indicators()
    {
        return $this->belongsToMany('App\Indication', 'indication_id');
    }
}
