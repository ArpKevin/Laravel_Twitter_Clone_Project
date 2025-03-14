<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use Illuminate\Http\Request;
use App\Models\Idea;

class IdeaController extends Controller
{
    public function store(CreateIdeaRequest $request){
        $validated = $request->validated();

        Idea::create([
            'content' => $validated['idea_content'] ?? null,
            "user_id"=>auth()->id()
        ]);

        return to_route('dashboard')->with('success','Idea was created successfully.');
    }
    public function show(Idea $idea){
        return view("ideas.show", compact("idea"));
    }
    public function edit(Idea $idea){

        // if(auth()->id() !== $idea->user_id){
        //     abort(404);
        // }

        $this->authorize('idea.edit', $idea);

        $editing_idea = true;

        return view("ideas.show", compact("idea", "editing_idea"));
    }

    public function update(UpdateIdeaRequest $request, $id)
    {
        $idea = Idea::findOrFail($id);

        $this->authorize('idea.edit', $idea);

        $validated = $request->validated();

        $idea->update([
            'content'=> $validated['idea_content'] ?? null,
        ]);

        if (auth()->user()->is_admin || auth()->user()->id === $idea->user_id) {
            return to_route('dashboard')->with('success','Idea was updated successfully.');
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function destroy($id)
    {
        $idea = Idea::findOrFail($id);

        if (auth()->user()->is_admin || auth()->user()->id === $idea->user_id) {
            $idea->delete();
            return to_route('dashboard')->with('success','Idea was deleted successfully.');
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
