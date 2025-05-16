<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderTrackingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_id' => $this->id,
            'status' => $this->latestStatus->status ?? 'Pending',
            'estimated_delivery_time' => $this->estimated_delivery_time,
            'delivery_location' => [
                'latitude' => $this->deliveryTracking->latitude ?? null,
                'longitude' => $this->deliveryTracking->longitude ?? null,
                'last_updated_at' => $this->deliveryTracking->last_updated_at ?? null,
            ],
            'contact' => [
                'delivery_person_phone' => $this->delivery_person_phone ?? null,
            ],
        ];
    }
}
