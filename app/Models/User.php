<?php

namespace App\Models;

use App\Models\Interfaces\ProfileInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
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
    protected $fillable = ['church_id', 'name', 'email', 'password', 'is_member', 'rg', 'cpf'];

    public function profile(): ProfileInterface
    {
        /** @var  ProfileInterface $profile */
        $profile = $this->hasOne(Responsible::class)->first();
        if (is_null($profile)) {
            $profile = $this->hasOne(Entrepreneur::class)->first();
        }
        if (is_null($profile)) {
            $profile = $this->hasOne(Member::class)->first();
        }
        if (is_null($profile)) {
            $profile = Member::create(['user_id' => $this->id]);
        }
        return $profile;
    }

    public function addresses(): Collection
    {
        return $this->hasMany(Address::class)->get();
    }

    public function indications(): Collection
    {
        return $this->hasMany(Indication::class)->get();
    }

    public function notifications(): Collection
    {
        return $this->hasMany(Notification::class)->get();
    }
}
