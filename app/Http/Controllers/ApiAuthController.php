<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Pin;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Registration successful!'], 201);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = \Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            $user->tokens()->delete();
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'token' => $token,
                "user" => $user
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    } 
    public function addPin(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'pin_id' => 'required|exists:pins,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        if ($request->user()->pins()->where('pin_id', $request->pin_id)->exists()) {
            return response()->json(['message' => 'You already have this Pin associated with your account.'], 409);
        }

        $pin = Pin::find($request->pin_id);
        $request->user()->pins()->attach($pin);

        return response()->json(['message' => 'Pin added successfully.']);
    }
    public function getUserPinIds(Request $request)
    {
        $pinIds = $request->user()->pins()->pluck('pin_id');
    
        return response()->json([
            'pin_ids' => $pinIds
        ]);
    }
}
