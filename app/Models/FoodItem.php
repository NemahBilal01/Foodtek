<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FoodItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'price',
        'image_path',
        'category_id',
        'restaurant_id',
        'item_option_id',
        'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];
// food item has many cart items
    public function cartItems():HasMany
    {
        return $this->hasMany(CartItem::class);
    }
    // food item has many order items
     public function orderItems():HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    // every food item belongs to one restaurants
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    // one food item belongs to one category
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    // food item has many special offer
    public function specialOffers():HasMany
    {
        return $this->hasMany(SpecialOffer::class);
    }
// food item has many ratings
    public function ratings():HasMany{
        return $this->hasMany(itemRating::class);
    }
}
