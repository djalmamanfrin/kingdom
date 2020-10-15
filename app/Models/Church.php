<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class Church extends Model
{
    protected $table = 'church';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['branch_id', 'address_id', 'name', 'cnpj'];

    public function branch()
    {
        $collection = $this->belongsTo(Branch::class)->get();
        if ($collection->isEmpty()) {
            throw new InvalidArgumentException('Branch collection is empty');
        }
        return $collection->get(0);
    }

    public function address(): Address
    {
        $collection = $this->belongsTo(Address::class)->get();
        if ($collection->isEmpty()) {
            throw new InvalidArgumentException('Address collection is empty');
        }
        return $collection->get(0);
    }
}
