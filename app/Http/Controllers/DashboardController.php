<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class DashboardController extends Controller
{
    public function index()
    {
        // $idea = new Idea();
        // $idea->content = "test";
        // $idea->likes = 0;
        // $idea->save();

        $idea = new Idea([
            'content' => 'hello ytb'
        ]);
        $idea->save();

        return view("dashboard", [
            'ideas'=> Idea::orderBy('created_at', 'desc')->get()
        ]);
    }
}
