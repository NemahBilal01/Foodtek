<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        return  Payment::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'order_id'=>'required|numeric|exists:orders,id',
            'amount'=>'required|numeric',
            'payment_method'=>'required|in:card,cash,paypal',
            'status'=>'required|in:pending,paid,failed',
            'transaction_id'=>'required|numeric|unique:payments',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors() , 400);
        }



        $payment = Payment::create([
                'order_id'=>$request->order_id,
                'amount'=>$request->amount,
                'payment_method'=>$request->payment_method,
                'status'=>$request->status,
                'transaction_id'=>$request->transaction,
            ]);

            return response()->json([$payment , 201 , 'message'=> 'your order done successfully']);

        }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return response()->json($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = Validator::make($request->all() , [
            'order_id'=>'required|numeric|exists:orders,id',
            'amount'=>'required|numeric',
            'payment_method'=>'required|in:card,cash,paypal',
            'status'=>'required|in:pending,paid,failed',
            'transaction_id'=>'required|numeric|unique:payments',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors() , 400);
        }

            $payment->update([
                'order_id'=>$request->order_id,
                'amount'=>$request->amount,
                'payment_method'=>$request->payment_method,
                'status'=>$request->status,
                'transaction_id'=>$request->transaction,
            ]);

            return response()->json($payment);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(['message'=>'deleted successfully'] ,200);
    }
}
