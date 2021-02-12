<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentReceipt extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shipment_receipts';

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
