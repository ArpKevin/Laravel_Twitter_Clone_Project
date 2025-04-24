<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return redirect()->route('users.show', $user->id)->with('success', 'You cannot follow yourself!');
        }

        $follower = auth()->user();

        $follower->followings()->syncWithoutDetaching($user); //->attach() allows duplicates

        return redirect()->route('users.show', $user->id)->with('success', 'Followed successfully!');
    }
    public function unfollow(User $user)
    {
        $follower = auth()->user();

        $follower->followings()->detach($user);

        return redirect()->route('users.show', $user->id)->with('success', 'Unfollowed successfully!');
    }
}
