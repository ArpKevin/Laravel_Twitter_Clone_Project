<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use Illuminate\Http\Request;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Pin::all(), 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function visit(Pin $pin)
    {
        $user = auth()->user();
        $user->pins()->attach($pin);
        return response()->json(['message' => 'Pin marked as visited'], 200);
    }
}
