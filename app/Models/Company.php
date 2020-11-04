<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['entrepreneur_id', 'category_id', 'address_id', 'name', 'cnpj'];

    public function entrepreneur(): Entrepreneur
    {
        return $this->belongsTo(Entrepreneur::class)->get()->first();
    }

    public function category(): Category
    {
        return $this->belongsTo(Category::class)->get()->first();
    }

    public function address(): Address
    {
        return $this->belongsTo(Address::class)->get()->first();
    }
}
