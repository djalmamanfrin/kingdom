<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrepreneur extends Model
{
    protected $table = 'entrepreneur';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id'];

    public function user(): User
    {
        return $this->belongsTo(User::class)->get()->first();
    }

    public function toArray(): array
    {
        $model = parent::toArray();
        $model['name'] = $this->getTable();
        return $model;
    }
}
