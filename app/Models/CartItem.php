<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'food_item_id',
        'quantity',
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
       }

       public function foodItem():BelongsTo
    {
        return $this->belongsTo(FoodItem::class);
    }
}
