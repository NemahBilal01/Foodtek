<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOption extends Model
{
    /** @use HasFactory<\Database\Factories\ItemOptionFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name_ar',
        'name_en',
        'is_active'
    ];

    
}
