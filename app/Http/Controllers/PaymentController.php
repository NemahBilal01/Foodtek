<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        // dd($payments);
        return view('payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * Store a newly created resource in storage.
     * storing a new payment record when a payment is made for an order
     */
    public function store(Request $request)
    {
        {
            $validated = $request->validate([
                'order_id' => 'required|exists:orders,id',
                'amount' => 'required|numeric|min:0',
                'payment_method' => 'required|in:card,cash,paypal',
                'status' => 'required|in:pending,paid,failed',
                'transaction_id' => 'nullable|string',
            ]);
        
            $payment = Payment::create($validated);
        
            return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
        }
    }

    /**
     * Display the specified resource.
     * display the details of a specific payment using its ID
     */
    public function show(string $id)
    {
        $payment = Payment::with('order')->findOrFail($id);
        return response()->json($payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment = Payment::findOrFail($id);
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     * to update the payment details, such as status or amount
     */
    public function update(Request $request, string $id)
    {
        {
            $payment = Payment::findOrFail($id);
        
            $validated = $request->validate([
                'amount' => 'sometimes|numeric|min:0',
                'payment_method' => 'sometimes|in:card,cash,paypal',
                'status' => 'sometimes|in:pending,paid,failed',
                'transaction_id' => 'nullable|string',
            ]);
        
            $payment->update($validated);
        
            return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * delete a payment record when it is no longer needed.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
    
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
