<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_account';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'name', 'agency', 'account', 'type', 'cpf', 'cnpj'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
