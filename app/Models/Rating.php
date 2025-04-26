<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    /** @use HasFactory<\Database\Factories\RatingFactory> */
    use HasFactory;

    protected $fillable=[
    'user_id',
    'food_item_id',
    'rate',
    'review'
];

// every rating belong to one user
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
// every rating belong to one food item
    public function foodItem() : BelongsTo {
        return $this->belongsTo(FoodItem::class);
    }
}
