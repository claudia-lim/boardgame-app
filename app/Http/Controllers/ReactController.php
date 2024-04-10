<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Inertia\Inertia;

class ReactController extends Controller
{
    public function test() {
        $user = Auth::user();
        return Inertia::render('Test', ['user'=>$user]);
    }

    public function index() {
        $user = Auth::user();
        $boardgames = $user->boardgames()->get();
        return Inertia::render('Boardgames/Index', ['boardgames'=>$boardgames, 'user'=>$user]);
    }

    public function create()
    {
        $user = Auth::user();
        return Inertia::render('Boardgames/Create', ['user'=>$user]);
    }

     public function show(string $id)
    {
        $boardgame = Boardgame::find($id);
        $users = $boardgame->users;
        $currentUser = Auth::user();
        $gameUserInfo = $currentUser->boardgames()->where('boardgame_id', $id)->first()->pivot;
        $publicComments = Comment::where('boardgame_id', $id)->where('public', 1)->orderByDesc('created_at')->get();
        $userComments = Comment::where('boardgame_id', $id)->where('user_id', $currentUser->id)->orderByDesc('created_at')->get();
//        dd($gameUserInfo);
        return Inertia::Render('Boardgames/Show',
            [
                'boardgame' => $boardgame,
                'gameUserInfo' => $gameUserInfo,
                'user'=>$currentUser,
                'publicComments'=>$publicComments,
                'userComments'=>$userComments
            ]);
    }

    public function edit(string $id)
    {
        $boardgame = Boardgame::find($id);
        $currentUser = Auth::user();
        $gameUserInfo = $currentUser->boardgames()->where('boardgame_id', $id)->first()->pivot;
        return Inertia::render('Boardgames/Edit', ['user'=>$currentUser, 'boardgame' => $boardgame, 'gameUserInfo' => $gameUserInfo]);
    }

    public function favouriteGames()
    {
        $user = Auth::user();
        $favouriteGames = $user->boardgames()->wherePivotIn('favourite', [1, 'on'])->get();
        return Inertia::render('Boardgames/Favourites', ['user'=>$user, 'favouriteGames'=>$favouriteGames]);
    }

    public function dashboard()
    {
        $user = Auth::user();
        return Inertia::render('Boardgames/Dashboard', ['user'=>$user]);
    }
}
