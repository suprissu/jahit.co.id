<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function inbox()
    {
        return $this->hasOne(Inbox::class);
    }

    public function negotiations()
    {
        return $this->hasMany(Negotiation::class);
    }
}
