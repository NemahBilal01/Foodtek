<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    public function index( string $id){
        $paymentMethods = PaymentMethod::where('user_id', $id)->get();

        return response()->json($paymentMethods);
    }
 
    public function store(Request $request){
        $validated = Validator::make($request->all() , [
            'user_id'=>'required|exists:users,id',
            'title' => 'nullable|string|max:255',
            'type'=>'required',
            'holder_name' => 'required|string|max:255',
            'card_number' => 'required|digits:16',
            'expire_date' => 'required|date_format:d/m',
            'CVC_code' => 'required|digits:3',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors());
        }
        // Get last 4 digits
        $cardNumber = $request->card_number;
        $lastFourDigits = substr($cardNumber, -4); 

        $paymentMethod = PaymentMethod::create([
            'user_id'=>$request->user_id,
            'title'=>$request->title,
            'type'=>$request->type,
            'last_four_digits'=>$lastFourDigits,
            'card_number'=>$cardNumber,
            'holder_name'=>$request->holder_name,
            'expire_date'=>Crypt::encryptString($request->expire_date),
            'CVC_code'=>Crypt::encryptString($request->CVC_code),
        ]);
        return response()->json([$paymentMethod ,'message'=>'new card stor successfully' ]);
    }
}
