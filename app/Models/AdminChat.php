<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminChat extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_chats';

    public function adminInboxes()
    {
        return $this->belongsTo(AdminInbox::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}