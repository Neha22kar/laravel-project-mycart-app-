<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password) 
        ]);

        $token = $user->createToken('Token')->accessToken;
     //   return response()->json(['token'=>$token,'user'=>$user,'message' => 'User registered successfully'],200);
        return response()->json(['user'=>$user,'message' => 'User registered successfully'],200);
    }
    
    public function login(Request $request)
    {
      $data = [
        'email' =>$request->email,
        'password' =>$request->password
      ];

      if(Auth()->attempt($data)){
        $user = Auth::user();
        $token = Auth()->user()->createToken('Token')->accessToken;

        // return response()->json(['token'=>$token,'user' => $user,'message' => 'Login successful'],200);
        return response()->json(['user' => $user,'message' => 'Login successful'],200);
    }
    else{
        return response()->json(['error'=>'unauthorized'],401);
    }
    }
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|unique:users',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     return response()->json(['user' => $user, 'message' => 'User registered successfully'], 201);
    // }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //     ]);

    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $user = Auth::user();
    //         $token = $user->createToken('authToken')->plainTextToken;

    //         return response()->json(['user' => $user, 'token' => $token, 'message' => 'Login successful'], 200);
    //     } else {
    //         return response()->json(['message' => 'Invalid credentials'], 401);
    //     }
    // }//
}
