<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['company_id', 'name', 'description', 'is_active'];

    public function company(): Company
    {
        return $this->belongsTo(User::class)->get()->first();
    }
}
