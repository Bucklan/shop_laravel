<?php

namespace App\Http\Controllers\Auth2;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
//        dd($request);
        $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'image' => 'image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $fileName = time() . $request->file('image')->getClientOriginalName();
            $image_path = $request->file('image')->storeAs('users', $fileName, 'public');
        }
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash:: make($request->input('password')),
            'role_id' => Role::where('name', 'user')->first()->id,
            'image' => 'storage/' . $image_path,
        ]);
        Auth::login($user);
        return redirect()->route('shops.index');


    }
}
