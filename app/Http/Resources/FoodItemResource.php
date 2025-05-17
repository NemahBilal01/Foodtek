<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodItemResource extends JsonResource
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
            // 'category_id' => $this->category_id,
            // 'name' => $this->when(app()->getLocale() === 'ar' && $this->name_ar, $this->name_ar, $this->name),
            // 'description' => $this->when(app()->getLocale() === 'ar' && $this->description_ar, $this->description_ar, $this->description),
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'description_en'=>$this->description_en,
            'description_ar'=>$this->description_ar,
            'price' => $this->price,
            'image_path' => $this->image_path,
            'is_available' => $this->is_available,
            'price_after_discount' => $this->whenLoaded('specialOffer', function () {
                return $this->specialOffer
                    ? $this->price - ($this->price * $this->specialOffer->discount_percentage / 100)
                    : null;
            }),

            'average_rating' => $this->when(isset($this->rating_avg), round($this->rating_avg, 1)),
            'number_of_reviews' => $this->when(isset($this->review_count), $this->review_count),
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            
        ];
    }
}
