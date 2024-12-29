<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class IdeaController extends Controller
{
    public function store(){
        request()->validate([
            'idea' => 'required|min:3|max:240'
        ]);

        // $idea = new Idea();
        // $idea->content = "test";
        // $idea->likes = 0;
        // $idea->save();

        Idea::create([
            'content' => request('idea', null)
        ]);

        return to_route('dashboard')->with('success','Idea was created successfully.');
    }

    public function destroy($id){
        Idea::findOrFail($id)->delete();
        return to_route('dashboard')->with('success','Idea was deleted successfully.');
    }
}
