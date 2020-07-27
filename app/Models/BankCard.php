<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{
    protected $table = 'bank_card';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'brand_id', 'owner', 'number', 'expiry_month', 'expiry_year'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function brand()
    {
        return $this->hasOne('App\Brand', 'brand_id');
    }

    public function Transactions()
    {
        return $this->hasMany('App\Transaction', 'transaction_id');
    }
}
