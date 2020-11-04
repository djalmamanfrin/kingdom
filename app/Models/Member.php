<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id'];

    public function user(): User
    {
        return $this->belongsTo(User::class)->get()->first();
    }
}
