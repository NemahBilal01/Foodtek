<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> 63258a0786a437f6d730ae70822114c1ed7608e1

class SpecialOffer extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'discount_percentage',
        'start_date',
        'end_date',
        'image',
        'is_active',
    ];
=======
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
>>>>>>> 63258a0786a437f6d730ae70822114c1ed7608e1
}
