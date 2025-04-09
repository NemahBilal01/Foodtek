<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users.index',compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {


        //incomig data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|string|max:15'
        ]);

        //create
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
        ]);
        
        return redirect()->route('users.index')->with('success', 'User created successfully!'); //for now to testing
    }


    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8|confirmed',
        'phone' => 'nullable|string|max:15'
    ]);

    // Check if phone number is already in use
    if ($request->phone && User::where('phone', $request->phone)->where('id', '!=', $user->id)->exists()) {
        return redirect()->back()->withErrors(['phone' => 'Phone number is already taken.']);
    }

    try {
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $request->filled('password') ? Hash::make($validated['password']) : $user->password,
            'phone' => $validated['phone']
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');

    } catch (QueryException $e) {
        return redirect()->back()->withErrors(['error' => 'Something went wrong! ' . $e->getMessage()]);
    }
}


    public function destroy(User $user)
    {
        $user->delete();
         return redirect()->route('users.index'); //for now to testing

    }
}
