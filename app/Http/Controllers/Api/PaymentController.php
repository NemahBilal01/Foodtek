<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return PaymentResource::collection($payments);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'order_id' => 'required|numeric|exists:orders,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:card,cash,paypal',
            'status' => 'required|in:pending,paid,failed',
            'transaction_id' => 'required|numeric|unique:payments',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

        $payment = Payment::create($validated->validated());

        return (new PaymentResource($payment))->additional([
            'message' => 'Your order has been processed successfully.'
        ]);
    }

    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = Validator::make($request->all(), [
            'order_id' => 'required|numeric|exists:orders,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:card,cash,paypal',
            'status' => 'required|in:pending,paid,failed',
            'transaction_id' => 'required|numeric|unique:payments,transaction_id,' . $payment->id,
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

        $payment->update($validated->validated());

        return new PaymentResource($payment);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
