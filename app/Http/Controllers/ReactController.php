<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Inertia\Inertia;
use Inertia\Response;

class ReactController extends Controller
{
    public function test() {
        $user = Auth::user();
        return Inertia::render('Test', ['user'=>$user]);
    }

    public function dashboard() {
        $user = Auth::user();
        $latestGame = $user->boardgames()->orderBy('boardgame_user.created_at', 'desc')->get();
        $latestComment = Comment::where('comments.user_id', $user->id)
            ->join('boardgames', 'comments.boardgame_id', '=', 'boardgames.id')
            ->join('boardgame_user', 'comments.boardgame_id', '=', 'boardgame_user.boardgame_id')
            ->orderByDesc('created_at')
            ->select('comments.*', 'boardgame_user.custom_name', 'boardgames.name')
            ->limit(1)->get();
        return Inertia::render('Dashboard', [
            'latestGame' => $latestGame,
            'latestComment' => $latestComment
        ]);
    }

    public function index() {
        $user = Auth::user();
        $boardgames = $user->boardgames()->orderby('boardgame_user.created_at', 'desc')->get();
        return Inertia::render('Boardgames/Index', [
            'boardgames'=>$boardgames,
            'user'=>$user
        ]);
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
            Log::info($game);
            if (DB::table('boardgame_user')->where('user_id', '=', $user->id)->where('boardgame_id', '=', $game[0]->id)->doesntExist()) {
                $user->boardgames()->attach($game[0]->id);
                $user->boardgames()->updateExistingPivot($game[0]->id, $imageUrl);
            } else {
                return back()->withErrors(['alreadyAdded'=>'Game is already in collection']);
            }
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
        $currentUser = Auth::user();
        $gameUserInfo = $currentUser->boardgames()->where('boardgame_id', $id)->first()->pivot;
       return Inertia::Render('Boardgames/Show',
            [
                'boardgame' => $boardgame,
                'gameUserInfo' => $gameUserInfo,
                'user'=>$currentUser,
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
            'name' => ['required', 'string']
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
        $favouriteGames = $user->boardgames()->wherePivotIn('favourite', [1, 'on', 'true'])->get();
        return Inertia::render('Boardgames/Favourites', ['user'=>$user, 'favouriteGames'=>$favouriteGames]);
    }

    public function deleteForever($id) {
        $deleted = DB::table('boardgames')->where('id', '=', $id)->delete();
        return to_route('boardgames.allgames');

    }

    public function updateFave(Request $request, string $id) {
        $favourite = $request->validate([
            'favourite'=>['boolean']
        ]);

//        Log::info($favourite);
        $currentUser = Auth::user();
        $currentUser->boardgames()->updateExistingPivot($id, ['favourite'=>$favourite['favourite']] );
        return 'updated game with favourite status of ' . ($favourite['favourite'] ? 'true' : 'false');
    }
}
