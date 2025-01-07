<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // duplicate compact('ideas') in show() and edit() to be refactored
    public function show(User $user){
        $ideas = $user->ideas()->latest()->paginate(5);

        return view("users.show", compact("user", "ideas"));
    }
    public function edit(User $user){
        $ideas = $user->ideas()->latest()->paginate(5);

        $editing = true;
        return view("users.show", compact("user", "editing", "ideas"));
    }
    public function update(){}
}
