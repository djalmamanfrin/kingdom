<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'state';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['country_id', 'name', 'code'];

    public function country(): Country
    {
        return $this->belongsTo(Country::class)->get()->first();
    }
}
