<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function store(Request $request)
    {

        $user = Auth::user();
        $request['name'] = trim($request['name']);
        $request['name'] = strtolower($request['name']);
        $imageUrl = $request->validate(['imageurl' => ['string', 'nullable', 'url']]);

        if (DB::table('boardgames')->where('name','=', $request['name'])->exists()) {
            $game = DB::table('boardgames')->where('name','=', $request['name'])->get();
            $user->boardgames()->attach($game[0]->id);
            $user->boardgames()->updateExistingPivot($game[0]->id, $imageUrl);

        } else {
            $gameName = $request->validate([
                'name' => ['required', 'string']
            ]);

            $newGame = Boardgame::create($gameName);
            $user->boardgames()->attach($newGame->id);
            $user->boardgames()->updateExistingPivot($newGame->id, $imageUrl);

            if ($request['favourite'])
            {
                $user->boardgames()->updateExistingPivot($newGame->id, ['favourite' => 1]);
            }

        }
        return to_route('boardgames.index');
    }

    public function show(string $id)
    {
        $boardgame = Boardgame::find($id);
//        $users = $boardgame->users;
        $currentUser = Auth::user();
        $gameUserInfo = $currentUser->boardgames()->where('boardgame_id', $id)->first()->pivot;
        $publicComments = Comment::where('boardgame_id', $id)->where('public', 1)->orderByDesc('created_at')->get();
        $userComments = Comment::where('boardgame_id', $id)->where('user_id', $currentUser->id)->orderByDesc('created_at')->get();
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

    public function update(Request $request, string $id)
    {
//        $game = Boardgame::find($id);
        $imageUrl = $request->validate([
            'imageUrl' => ['string', 'nullable', 'url']
        ]);
//        $game->update(array_filter($data));
        $name = $request->validate([
            'name' => ['string']
        ]);
//dd($imageUrl);
        $currentUser = Auth::user();
        $currentUser->boardgames()->updateExistingPivot($id, ['custom_name' => $request['name']]);
        $currentUser->boardgames()->updateExistingPivot($id, ['favourite' => $request['favourite'] ? $request['favourite'] : 0]);
        $currentUser->boardgames()->updateExistingPivot($id, $imageUrl);

        return to_route('boardgames.show', $id);
    }

    public function destroy(string $id)
    {
        $user = Auth::user();
        $user->boardgames()->detach($id);
        return to_route('boardgames.index');
    }
    public function favouriteGames()
    {
        $user = Auth::user();
        $favouriteGames = $user->boardgames()->wherePivotIn('favourite', [1, 'on'])->get();
        return Inertia::render('Boardgames/Favourites', ['user'=>$user, 'favouriteGames'=>$favouriteGames]);
    }

}
