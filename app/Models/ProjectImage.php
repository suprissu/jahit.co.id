<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_images';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
