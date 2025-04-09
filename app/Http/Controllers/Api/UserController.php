<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        return User::all();
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function store(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|string|max:15'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
        ]);
        return response()->json($user , 201);
    }


    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
{
    $validated = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'phone' => 'nullable|string|max:15'
    ]);

    if ($validated->fails()) {
        return response()->json($validated->errors(), 400);
    }

    // Check if phone number is already in use
    if ($request->phone && User::where('phone', $request->phone)->where('id', '!=', $user->id)->exists()) {
        return redirect()->back()->withErrors(['phone' => 'Phone number is already taken.']);
    }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
            'phone' => $request->phone
        ]);

        return response()->json($user);

}


    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message'=>'deleted successfully'] ,200);

    }
}
