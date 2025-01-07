<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class IdeaController extends Controller
{
    public function store(){
        request()->validate([
            'idea_content' => 'required|min:3|max:240'
        ]);

        Idea::create([
            'content' => request('idea_content', null),
            "user_id"=>auth()->id()
        ]);

        return to_route('dashboard')->with('success','Idea was created successfully.');
    }
    public function show(Idea $idea){
        return view("ideas.show", compact("idea"));
    }
    public function edit(Idea $idea){

        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

        $editing_idea = true;

        return view("ideas.show", compact("idea", "editing_idea"));
    }

    public function update(Idea $idea){
        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

        request()->validate([
            'idea_content' => 'required|min:3|max:240'
        ]);

        $idea->update([
            'content'=> request('idea_content', null)
        ]);

        return to_route('ideas.show', $idea->id)->with('success','Idea was updated successfully.');
    }
    public function destroy(Idea $idea)
    {
        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

        $idea->delete();
        return to_route('dashboard')->with('success', 'Idea was deleted successfully.');
    }
}
