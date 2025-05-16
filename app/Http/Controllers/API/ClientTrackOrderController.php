<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderTrackingResource;

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

        return new OrderTrackingResource($order);
    }
}

