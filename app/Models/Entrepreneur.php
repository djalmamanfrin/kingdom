<?php

namespace App\Models;

use App\Models\Profile\ProfileInterface;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Entrepreneur extends Model implements ProfileInterface
{
    const TYPE = 'entrepreneur';
    protected $table = 'entrepreneur';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id'];

    public function user(): User
    {
        return $this->belongsTo(User::class)->get()->first();
    }

    public function companies(): Collection
    {
        return $this->hasMany(Company::class)->get();
    }

    public function getId():int
    {
        return $this->id;
    }

    public function type(): string
    {
        return $this->getTable();
    }

    public function getUpdateAt(): DateTime
    {
        return $this->update_at;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
}
