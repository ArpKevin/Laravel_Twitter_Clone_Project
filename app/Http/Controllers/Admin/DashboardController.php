<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\Pin;

class DashboardController extends Controller
{
    public function index(){
        // if(!Gate::allows('admin')) abort(403);
        // $this->authorize('admin');

        return view('admin.dashboard', [
            'pins' => Pin::paginate(5)
        ]);
    }
}
