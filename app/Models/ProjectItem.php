<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class ProjectItem extends Model
{
    protected $table = 'project_item';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['project_id', 'product_id'];

    public function project()
    {
        $collection = $this->belongsTo(Project::class)->get();
        if ($collection->isEmpty()) {
            throw new InvalidArgumentException('Project collection is empty', 422);
        }
        return $collection->get(0);
    }

    public function product()
    {
        $collection = $this->belongsTo(Product::class)->get();
        if ($collection->isEmpty()) {
            throw new InvalidArgumentException('Product collection is empty', 422);
        }
        return $collection->get(0);
    }
}
