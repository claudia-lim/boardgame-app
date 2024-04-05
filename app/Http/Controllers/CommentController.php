<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create($boardgame_id) {
        $boardgame = Boardgame::find($boardgame_id);
//        dd($boardgame);
        return view('comments.addcomment', ['boardgame_id'=>$boardgame_id, 'game' => $boardgame]);
    }
    public function addComment(Request $request, string $id) {
//        dd($request['public']);
        $currentUser = Auth::user();
        $request['comment'] = trim($request['comment']);
        $data = $request->validate([
            'comment' => ['string', 'required'],
            'public' => ['required']
        ]);
        $data['boardgame_id'] = $id;
        $data['user_id'] = $currentUser->id;
        $data['public'] = $request['public'] == 'yes' ? 1 : 0;
//        dd($data);

        $newComment = Comment::create($data);
//        dd($newComment);
        return to_route('boardgames.show', $id);
    }
}
