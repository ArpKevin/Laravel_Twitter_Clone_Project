<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class DashboardController extends Controller
{
    public function index()
    {
        $idea = Idea::orderBy('created_at', 'desc');
        if(request()->has('search')){
            $idea = Idea::where('content','like','%'.request()->search.'%');
        }

        return view("dashboard", [
            'ideas'=> $idea->paginate(5)
        ]);
    }
}
