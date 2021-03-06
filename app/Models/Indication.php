<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indication extends Model
{
    protected $table = 'indication';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'name', 'email'];

    public function user(): User
    {
        return $this->belongsTo(User::class)->get()->first();
    }
}
