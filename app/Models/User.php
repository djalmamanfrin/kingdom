<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use SoftDeletes, Authenticatable, Authorizable;

    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $hidden = ['password'];
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['profile_id', 'name', 'email', 'password', 'is_member', 'rg', 'cpf'];

    public function profile(): Profile
    {
        $collection = $this->belongsTo(Profile::class)->get();
        if ($collection->isEmpty()) {
            throw new InvalidArgumentException('Profile collection is empty');
        }
        return $collection->get(0);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function bankCards()
    {
        return $this->hasMany(BankCard::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function indications()
    {
        return $this->hasMany(Indication::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
