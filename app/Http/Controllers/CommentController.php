<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Idea $idea){
        request()->validate([
            "comment_content"=> "required",
        ]);

        $idea->comments()->create([
            "idea_id"=> $idea->id,
            "user_id"=>auth()->id(),
            "content"=> request()->get("comment_content")
        ]);



        return to_route('ideas.show', $idea->id)->with("success","Comment successfully added");
    }
}
