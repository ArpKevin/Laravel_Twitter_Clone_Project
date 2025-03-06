<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Http\Request;

class DataExportController extends Controller
{
    public function exportData(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();
        
        // Get user's data including their ideas and comments
        $userData = User::with(['ideas', 'comments', 'followers', 'followings'])->findOrFail($user->id);
        
        // Export user data with their ideas and comments
        $exportData = [
            'user' => [
                'id' => $userData->id,
                'name' => $userData->name,
                'email' => $userData->email,
                'bio' => $userData->bio,
                'image_url' => $userData->getImageURL(),
                'created_at' => $userData->created_at,
            ],
            'ideas' => $userData->ideas->map(function ($idea) {
                return [
                    'id' => $idea->id,
                    'content' => $idea->content,
                    'created_at' => $idea->created_at,
                ];
            }),
            'comments' => $userData->comments->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at,
                ];
            }),
            'stats' => [
                'followers_count' => $userData->followers->count(),
                'following_count' => $userData->followings->count(),
            ]
        ];

        return response()->json($exportData);
    }

    public function getAllPublicData()
    {
        // Get all public ideas with user information
        $ideas = Idea::with('user')
            ->latest()
            ->get()
            ->map(function ($idea) {
                return [
                    'id' => $idea->id,
                    'content' => $idea->content,
                    'created_at' => $idea->created_at,
                    'user' => [
                        'id' => $idea->user->id,
                        'name' => $idea->user->name,
                        'image_url' => $idea->user->getImageURL(),
                    ],
                ];
            });

        return response()->json([
            'ideas' => $ideas,
        ]);
    }
}
