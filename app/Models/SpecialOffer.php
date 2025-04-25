<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecialOffer extends Model
{
    use HasFactory;

    protected $fillable=[
        'food_item_id',
        'discount_percent',
        'start_at',
        'end-at',
        'description'
    ];

    public function foodItem():BelongsTo {
        return $this->belongsTo(FoodItem::class);
    }
}
