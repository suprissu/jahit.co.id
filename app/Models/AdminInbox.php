<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminInbox extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_inboxes';

    public function receiver()
    {
        return $this->belongsTo(User::class);
    }

    public function adminChats()
    {
        return $this->hasMany(AdminChat::class, 'admin_inbox_id', 'id');
    }
}