<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $hidden = ['password'];
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_type_id', 'name', 'email', 'password', 'is_member', 'rg', 'cpf'];

    public function type()
    {
        return $this->hasMany('App\UserType', 'user_type_id');
    }

    public function branches()
    {
        return $this->hasMany('App\Branch', 'branch_id');
    }

    public function bankCards()
    {
        return $this->hasMany('App\BankCard', 'bank_card_id');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address', 'address_id');
    }

    public function indications()
    {
        return $this->hasMany('App\Indication', 'indication_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification', 'notification_id');
    }
}
