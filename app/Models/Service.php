<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Searchable;

    protected $table = 'service';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['company_id', 'name', 'description', 'tags', 'is_active'];

    public function getElasticsearchIndex(): string
    {
        return 'services';
    }

    public function getFields(): array
    {
        return ['tags'];
    }

    public function getData(): array
    {
        return $this->toArray();
    }

    public function company(): Company
    {
        return $this->belongsTo(User::class)->get()->first();
    }
}
