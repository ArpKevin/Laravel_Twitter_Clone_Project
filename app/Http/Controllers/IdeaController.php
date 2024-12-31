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
            'content' => request('idea_content', null)
        ]);

        return to_route('dashboard')->with('success','Idea was created successfully.');
    }
    public function show(Idea $idea){
        return view("ideas.show", compact("idea"));
    }
    public function edit(Idea $idea){
        $editing = true;

        return view("ideas.show", compact("idea", "editing"));
    }

    public function update(Idea $idea){
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
        $idea->delete();
        return to_route('dashboard')->with('success', 'Idea was deleted successfully.');
    }
}
