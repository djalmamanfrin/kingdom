<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['state_id', 'name'];

    public function state()
    {
        return $this->belongsTo('App\Stage', 'state_id');
    }
}
