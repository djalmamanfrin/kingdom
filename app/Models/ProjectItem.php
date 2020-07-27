<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectItem extends Model
{
    protected $table = 'project_item';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['project_id', 'product_id'];

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'product_id');
    }
}
