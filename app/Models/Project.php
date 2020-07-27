<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['branch_id', 'project_type_id', 'title', 'description', 'delivery_at', 'expected_at'];

    public function branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id');
    }

    public function projectType()
    {
        return $this->hasOne('App\ProjectType', 'project_type_id');
    }
}
