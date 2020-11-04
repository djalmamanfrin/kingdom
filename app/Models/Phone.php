<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phone';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'country', 'number'];

    public function user(): User
    {
        return $this->belongsTo(User::class)->get()->first();
    }

    public function country(): Country
    {
        return $this->belongsTo(Country::class)->get()->first();
    }
}
