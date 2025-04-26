<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class SpecialOffer extends Model
{
    use HasFactory;


    protected $fillable = [
        'food_item_id',
        'category_id',
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'discount_percentage',
        'start_date',
        'end_date',
        'limit_amount',
        'person_amount',
        'image',
        'is_active',
    ];
    public function foodItem():BelongsTo {
        return $this->belongsTo(FoodItem::class);
    }

    public function category():BelongsTo {
        return $this->belongsTo(FoodItem::class);
    }

}
