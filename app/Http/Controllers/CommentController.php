<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function create($boardgame_id) {
        $boardgame = Boardgame::find($boardgame_id);
        $currentUser = Auth::user();
        return Inertia::render('Boardgames/AddComment', [
            'user'=>$currentUser,
            'boardgame'=>$boardgame
        ]);
    }

    public function addComment(Request $request, string $id) {
        $currentUser = Auth::user();
        $request['comment'] = trim($request['comment']);
        $data = $request->validate([
            'comment' => ['string', 'required'],
            'public' => ['required', 'boolean']
        ]);
        $data['boardgame_id'] = $id;
        $data['user_id'] = $currentUser->id;
        $newComment = Comment::create($data);
        return to_route('boardgames.show', $id);
    }

    public function deleteComment($id) {
        $boardgameId = Comment::where('id', $id)->select('comments.boardgame_id')->get();
        Log::info($boardgameId);
        $deleted = Comment::where('id', $id)->delete();
        return to_route('boardgames.show', $boardgameId[0]['boardgame_id']);
    }
}
