<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'restaurant_id',
        'image',
        'is_active',
    ];
    public function foodItems()
    {
        return $this->hasMany(FoodItem::class);
    }

    public function restaurant() :BelongsTo{
        return $this->belongsTo(Restaurant::class);
    }

    public function specialOffer():HasMany
    {
        return $this->hasMany(SpecialOffer::class);
    }
}
