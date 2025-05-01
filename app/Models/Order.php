<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total_price',
        'payment_status',
        'restaurant_id'
    ];
    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function items():HasMany{
        return $this->hasMany(OrderItem::class);
    }

    public function foodItems()
    {
    return $this->hasManyThrough(FoodItem::class, OrderItem::class, 'order_id', 'id', 'id', 'food_item_id');
    }
    public function payment():HasMany{
        return $this->hasMany(Payment::class);
    }

    public function deliveryStatuses() {
        return $this->hasMany(DeliveryStatus::class);

    }
    public function tracking()
    {
        return $this->hasMany(DeliveryTracking::class);
        // One order → Many tracking updates
    }

    public function latestStatus()
    {
        return $this->hasOne(DeliveryStatus::class)->latestOfMany();
    }
    public function chats()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

  

}
