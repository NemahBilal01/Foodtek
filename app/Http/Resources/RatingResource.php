<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
            'food_item_id' => $this->food_item_id,
            'user_id' => $this->user_id,
            'rate' => $this->rate,
            'review' => $this->review,
            // 'created_at' => $this->created_at,
        ];
    }
}
