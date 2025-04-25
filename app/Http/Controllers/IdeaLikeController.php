<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea){
        if ($idea->user_id === auth()->user()->id) {
            return redirect()->route('dashboard', $idea->id)->with('success', 'You cannot like your own idea!');
        }
        
        $liker = auth()->user();

        $liker->likes()->syncWithoutDetaching($idea);

        return redirect()->route('dashboard', $idea->id)->with('success', 'Liked successfully!');
    }
    public function unlike(Idea $idea){
        $liker = auth()->user();

        $liker->likes()->detach($idea);

        return redirect()->route('dashboard', $idea->id)->with('success', 'Unliked successfully!');
    }
}
