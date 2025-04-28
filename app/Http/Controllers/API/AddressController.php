<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     * // GET /api/addresses
     */
    public function index()
    {
        return Address::all();
        
        //return Address::with('user')->get();
        //return Address::paginate(10);
    }
    public function userLocation(string $id){
       $userLocation = Address::where('user_id','=',$id)->get();
       return response()->json($userLocation);
    }

    /**
     * Store a newly created resource in storage.
     * // POST /api/addresses
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
            'address_line' => 'required|string|max:255',
            'description' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(),400);
        }

            $address = Address::create([
                'user_id'=>$request->user_id,
                'address_line'=>$request->address_line,
                'description'=>$request->description,
                'province'=>$request->province,
                'city'=>$request->city,
                'zip_code'=>$request->zip_code,
                        ]);


        // $validated = $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'address_line' => 'required|string|max:255',
        //     'country' => 'required|string|max:100',
        //     'state' => 'required|string|max:100',
        //     'city' => 'required|string|max:100',
        //     'zip_code' => 'required|string|max:20',
        // ]);

        // $address = Address::create($validated);

        return response()->json([$address, 'message'=>'“New Delivery Address Has been Added'], 201);
    }

    /**
     * Display the specified resource.
     * // GET /api/addresses/{id}
     */
    public function show(string $id)
    {
        $address = Address::findOrFail($id);
        return response()->json($address);
        //return Address::with('user')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     * // PUT /api/addresses/{id}
     */
    public function update(Request $request, string $id)
    {
        $address = Address::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'address_line' => 'sometimes|string|max:255',
            'country' => 'sometimes|string|max:100',
            'state' => 'sometimes|string|max:100',
            'city' => 'sometimes|string|max:100',
            'zip_code' => 'sometimes|string|max:20',
        ]);

        $address->update($validated);
        return response()->json($address);
    }

    /**
     * Remove the specified resource from storage.
     * // DELETE /api/addresses/{id}
     */
    public function destroy(string $id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return response()->json(['message' => 'Address deleted successfully.'], 200);
    }

    //Soft Delete Recovery
    /*public function restore($id)
    {
        $address = Address::withTrashed()->findOrFail($id);
        $address->restore();
        return response()->json(['message' => 'Address restored.']);
    }*/

}
