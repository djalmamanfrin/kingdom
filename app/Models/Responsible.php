<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsible extends Model
{
    protected $table = 'responsible';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id'];

    public function user(): User
    {
        return $this->belongsTo(User::class)->get()->first();
    }
}
