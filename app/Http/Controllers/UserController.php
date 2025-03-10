<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user', ['except' => ['show', 'profile']]);
    }

    // duplicate compact('ideas') in show() and edit() to be refactored
    public function show(User $user){
        $ideas = $user->ideas()->latest()->paginate(5);

        return view("users.show", compact("user", "ideas"));
    }
    public function edit(User $user){
        $ideas = $user->ideas()->latest()->paginate(5);

        $editing = true;
        return view("users.edit", compact("user", "editing", "ideas"));
    }
    public function update(UpdateUserRequest $request, User $user){
        $validated = $request->validated();

        if($request->has("image")){
            $imagePath = $request->file("image")->store("profile", "public");
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);

        return redirect()->route("profile");
    }

    public function profile(){
        return $this->show(auth()->user());
    }
}
