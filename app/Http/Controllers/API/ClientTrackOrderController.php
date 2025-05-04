<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ClientTrackOrderController extends Controller
{
    public function trackOrder($orderId)
    {
        $order = Order::with([
            'latestStatus:id,order_id,status,created_at',
            'deliveryTracking' => function($query) {
                $query->latest('last_updated_at');
            }
        ])->findOrFail($orderId);

        return response()->json([
            'order_id' => $order->id,
            'status' => $order->latestStatus->status ?? 'Pending',
            'estimated_delivery_time' => $order->estimated_delivery_time,
            'delivery_location' => [
                'latitude' => $order->deliveryTracking->latitude ?? null,
                'longitude' => $order->deliveryTracking->longitude ?? null,
                'last_updated_at' => $order->deliveryTracking->last_updated_at ?? null,
            ],
            'contact' => [
                'delivery_person_phone' => $order->delivery_person_phone ?? null,
            ]
        ]);
    }
}

