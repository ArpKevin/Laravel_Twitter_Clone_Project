<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CreateCommentRequest $request ,Idea $idea){
        $validated = $request->validated();

        $idea->comments()->create([
            "idea_id"=> $idea->id,
            "user_id"=>auth()->id(),
            "content"=>$validated["comment_content"]
        ]);



        return to_route('ideas.show', $idea->id)->with("success","Comment successfully added");
    }
}
