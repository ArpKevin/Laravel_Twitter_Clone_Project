<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }
    public function store(){
        $validated = request()->validate([
            'name'=>'required|min:3|max:40',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|confirmed|min:8'
        ]);

        $user = User::create([
            'name'=> $validated['name'],
            'email'=> $validated['email'],
            'password'=> Hash::make($validated['password']),
        ]);

        // Mail::to($user->email)
        // ->send(new WelcomeEmail($user));

        return redirect()->route('login')->with('success','Account created successfully');
    }

    public function login(){
        return view('auth.login');
    }

    public function authenticate(){
        $validated = request()->validate([
            'email'=> 'required|email',
            'password'=> 'required|min:8'
        ]);

        if(auth()->attempt($validated)){
            request()->session()->regenerate();
            return redirect()->route('dashboard')->with('success','Logged in as ' . auth()->user()->name);
        }

        return redirect()->route('login')->withErrors([
            'email'=> 'No matching email and password combination found.'
        ]);
    }
    public function logout(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerate();

        return redirect()->route('dashboard')->with('success','Successfully logged out');
    }
    public function getUserPinIds()
    {
        $user = auth()->user();
    return response()->json($user->pins()->pluck('id')->toArray());
    }

    public function addPin(Request $request)
    {
        $request-
        validate([
            'pin_id' => 'required|exists:pin,id',
        ]);

        // $exists = DB::table('pin_user')
        // ->where('pin_id', $request->pin_id)
        // ->where('user_id', $request->user()->id)
        // ->exists();

        // if ($exists) {
        //     return response()->json(['message' => 'You already have this Pin associated with your account.'], 409);
        // }

        if ($request->user()->pins()->where('pin_id', $request->pin_id)->exists()) {
            return response()->json(['message' => 'You already have this Pin associated with your account.'], 409);
        }

        $pin = Pin::find($request->pin_id);

        $request->user()->pins()->attach($pin);
        return response()->json(['message' => 'Pin added successfully.']);
    }
}
