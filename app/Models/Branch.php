<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Branch extends Model
{
    protected $table = 'branch';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['responsible_id', 'name', 'email', 'site'];

    public function responsible(): Responsible
    {
        return $this->belongsTo(User::class)->get()->first();
    }

    public function churches(): Collection
    {
        return $this->hasMany(Church::class)->get();
    }
}
