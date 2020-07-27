<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['order_id', 'bank_card_id', 'currency_id', 'value'];

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }

    public function bankCard()
    {
        return $this->hasOne('App\BankCard', 'bank_card_id');
    }

    public function currency()
    {
        return $this->hasOne('App\Currency', 'currency_id');
    }
}
