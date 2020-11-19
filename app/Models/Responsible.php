<?php

namespace App\Models;

use App\Models\Profile\ProfileInterface;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Responsible extends Model implements ProfileInterface
{
    const TYPE = 'responsible';
    protected $table = 'responsible';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id'];

    public function user(): User
    {
        return $this->belongsTo(User::class)->get()->first();
    }

    public function branches(): Collection
    {
        return $this->hasMany(Branch::class)->get();
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
