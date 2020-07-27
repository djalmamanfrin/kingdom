<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'name', 'email', 'site'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function projects()
    {
        return $this->hasMany('App\Project', 'project_id');
    }

    public function churches()
    {
        return $this->hasMany('App\Church', 'church_id');
    }

    public function address()
    {
        return $this->hasOne('App\Address', 'address_id');
    }

    public function bankAccounts()
    {
        return $this->hasMany('App\BankAccount', 'bank_account_id');
    }
}
