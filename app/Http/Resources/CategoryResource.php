<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            // 'restaurant_id' => $this->restaurant_id,
            'name' => app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en,
            'is_active' => $this->is_active,
            // 'created_at' => $this->created_at,
            'food_items' => FoodItemResource::collection($this->whenLoaded('foodItems')),
        ];
    }
}
