<?php

namespace App\Models;

use App\Models\Interfaces\ProfileInterface;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Member extends Model implements ProfileInterface
{
    const TYPE = 'member';
    protected $table = 'member';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id'];

    public function user(): User
    {
        return $this->belongsTo(User::class)->get()->first();
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
