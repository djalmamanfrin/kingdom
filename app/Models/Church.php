<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    protected $table = 'church';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['branch_id', 'address_id', 'name', 'cnpj'];

    public function branch(): Branch
    {
        return $this->belongsTo(Branch::class)->get()->first();
    }

    public function address(): Address
    {
        return $this->belongsTo(Address::class)->get()->first();
    }
}
