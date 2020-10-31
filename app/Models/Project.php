<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class Project extends Model
{
    protected $table = 'project';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['branch_id', 'project_type_id', 'title', 'description', 'delivery_at', 'expected_at'];

    public function branch(): Branch
    {
        $collection = $this->belongsTo(Branch::class)->get();
        if ($collection->isEmpty()) {
            throw new InvalidArgumentException('Branch collection is empty', 422);
        }
        return $collection->get(0);
    }

    public function projectType(): ProjectType
    {
        $collection = $this->belongsTo(ProjectType::class)->get();
        if ($collection->isEmpty()) {
            throw new InvalidArgumentException('Project Type collection is empty', 422);
        }
        return $collection->get(0);
    }

    public function items(): Collection
    {
        return $this->hasMany(ProjectItem::class)->get();
    }

    public function toArray()
    {
        $project = parent::toArray();
        // unset($project['project_type_id']);
        $project['type'] = $this->projectType()->name;
        return $project;
    }
}
