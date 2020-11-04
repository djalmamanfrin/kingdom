<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['company_id', 'is_active', 'value', 'sale_value', 'quantity'];

    public function company(): Company
    {
        return $this->belongsTo(User::class)->get()->first();
    }
}
