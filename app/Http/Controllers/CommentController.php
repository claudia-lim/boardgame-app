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
    public function create($boardgame_id)
    {
        $boardgame = Boardgame::find($boardgame_id);
        $currentUser = Auth::user();
        return Inertia::render('Boardgames/AddComment', [
            'user'=>$currentUser,
            'boardgame'=>$boardgame
        ]);
    }

    public function addComment(Request $request, string $id)
    {
        $currentUser = Auth::user();
        $request['comment'] = trim($request['comment']);
        $data = $request->validate([
            'comment' => ['string', 'required', 'required'],
            'public' => ['required', 'boolean']
        ]);
        $data['boardgame_id'] = $id;
        $data['user_id'] = $currentUser->id;
        $newComment = Comment::create($data);
        return to_route('boardgames.show', $id);
    }

    public function showPublicComments(string $id)
    {
        $publicComments = Comment::where('boardgame_id', $id)->join('users', 'user_id', '=', 'users.id')->where('public', 1)->select('comments.*', 'users.name')->orderByDesc('created_at')->paginate(4);
        return $publicComments;
    }

    public function showUserComments(string $id)
    {
        $currentUser = Auth::user();
        $userComments = Comment::where('boardgame_id', $id)->join('users', 'user_id', '=', 'users.id')->where('user_id', $currentUser->id)->select('comments.*', 'users.name')->orderByDesc('created_at')->paginate(4);
        return $userComments;
    }

    public function deleteComment(string $id)
    {
        $boardgameId = Comment::where('id', $id)->select('comments.boardgame_id')->get();
//        Log::info($boardgameId);
        Comment::where('id', $id)->delete();
        return to_route('boardgames.show', $boardgameId[0]['boardgame_id']);
    }

    public function editComment($id)
    {
        $currentComment = Comment::find($id);
        $user = Auth::user();
        return Inertia::render('Boardgames/EditComment', [
            'currentComment'=>$currentComment,
            'user'=>$user]);
    }

    public function updateComment(Request $request, string $id)
    {
        $data = $request->validate([
            'comment' => ['required', 'string'],
            'public' => ['required', 'boolean']
        ]);
        $currentComment = Comment::find($id);
        $currentComment->comment = $data['comment'];
        $currentComment->public = $data['public'];
        $currentComment->save();
//        Log::info($currentComment->boardgame_id);
        return to_route('boardgames.show', $currentComment->boardgame_id);
    }
}
