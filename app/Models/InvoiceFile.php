<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceFile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoice_files';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
