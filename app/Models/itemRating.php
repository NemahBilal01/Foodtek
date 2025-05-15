<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemRating extends Model
{
    use HasFactory;

    protected $fillable = [

        'food_item_id',
        'rate',
        'review'
    ];

    public function foodItem():BelongsTo{
        return $this->belongsTo(FoodItem::class);
    }
}
