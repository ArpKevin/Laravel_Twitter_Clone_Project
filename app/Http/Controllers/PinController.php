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
        return response()->json(Pin::with('pinCategory')->get(), 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
