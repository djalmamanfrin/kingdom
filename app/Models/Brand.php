<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['name', 'description'];

    public function bankCards()
    {
        return $this->belongsToMany('App\BankCard', 'brand_id');
    }
}
