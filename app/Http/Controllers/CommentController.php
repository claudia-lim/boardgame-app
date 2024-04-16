<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function create($boardgame_id) {
        $boardgame = Boardgame::find($boardgame_id);
        $currentUser = Auth::user();
//        dd($boardgame);
//        return view('comments.addcomment', ['boardgame_id'=>$boardgame_id, 'game' => $boardgame]);
        return Inertia::render('Boardgames/AddComment', [
            'user'=>$currentUser,
            'boardgame'=>$boardgame
        ]);
    }


    public function addComment(Request $request, string $id) {
//        dd($request['public']);
        $currentUser = Auth::user();
        $request['comment'] = trim($request['comment']);
        $data = $request->validate([
            'comment' => ['string', 'required'],
            'public' => ['required', 'boolean']
        ]);
        $data['boardgame_id'] = $id;
        $data['user_id'] = $currentUser->id;
//        dd($data);

        $newComment = Comment::create($data);
//        dd($newComment);
        return to_route('boardgames.show', $id);
    }

    public function deleteComment($commentId) {
        $deleted = Comment::where('id', $commentId)->delete();
        return back();
    }
}
