<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'samples';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function negotiation()
    {
        return $this->belongsTo(Negotiation::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function receipt()
    {
        return $this->hasOne(ShipmentReceipt::class);
    }
}