<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phone';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'country', 'number'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }
}
