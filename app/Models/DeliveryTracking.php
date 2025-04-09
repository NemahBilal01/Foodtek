<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTracking extends Model
{
    /** @use HasFactory<\Database\Factories\DeliveryTrackingFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'latitude',
        'longitude',
        'last_updated_at'
    ];
    protected $casts = [
        'last_updated_at' => 'datetime',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
