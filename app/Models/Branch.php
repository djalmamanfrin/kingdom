<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class Branch extends Model
{
    protected $table = 'branch';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'name', 'email', 'site'];

    public function user(): User
    {
        $collection = $this->belongsTo(User::class)->get();
        if ($collection->isEmpty()) {
            throw new InvalidArgumentException('User collection is empty');
        }
        return $collection->get(0);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function churches()
    {
        return $this->hasMany(Church::class);
    }
}
