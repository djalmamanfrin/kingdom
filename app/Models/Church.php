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

    public function branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id');
    }

    public function address()
    {
        return $this->hasOne('App\Address', 'address_id');
    }
}
