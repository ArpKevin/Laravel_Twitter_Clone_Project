<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $ideas = Idea::orderBy('created_at', 'desc');

        $ideas = $ideas->search(request()->search);

        return view("dashboard", [
            'ideas'=> $ideas->paginate(5)
        ]);
    }
}
