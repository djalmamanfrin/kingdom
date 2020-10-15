<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class BankAccount extends Model
{
    protected $table = 'bank_account';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'bank_id', 'nickname', 'document', 'agency', 'account', 'type'];

    public function user(): User
    {
        $collection = $this->belongsTo(User::class)->get();
        if ($collection->isEmpty()) {
            throw new InvalidArgumentException('User collection is empty', 422);
        }
        return $collection->get(0);
    }

    public function bank(): Bank
    {
        $collection = $this->belongsTo(Bank::class)->get();
        if ($collection->isEmpty()) {
            throw new InvalidArgumentException('Bank collection is empty', 422);
        }
        return $collection->get(0);
    }
}
