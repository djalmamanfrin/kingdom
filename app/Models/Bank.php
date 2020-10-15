<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Bank extends Model
{
    protected $table = 'bank';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['cod', 'name', 'ispb'];

    public function bankAccounts(): Collection
    {
        return $this->hasMany(BankAccount::class)->get();
    }
}
