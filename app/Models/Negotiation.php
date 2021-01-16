<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'negotiations';

    public function inbox()
    {
        return $this->belongsTo(Inbox::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
    
    public function sample()
    {
        return $this->hasOne(Sample::class);
    }
}