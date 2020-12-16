<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
        
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function inboxes()
    {
        return $this->hasMany(Inbox::class);
    }

    public function negotiations()
    {
        return $this->hasMany(Negotiation::class);
    }
}
