<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\BoardgameUser;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BoardgameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $user = Auth::user();
//        dd(Boardgame::query()->get());
        $boardgames = $user->boardgames()->get();
//        dd($boardgames);

        return view('boardgames.index', ['boardgames' => $boardgames]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('boardgames.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request);
        $user = Auth::user();
        $request['name'] = trim($request['name']);
        $request['name'] = strtolower($request['name']);

        $imageUrl = $request->validate(['imageurl' => ['string', 'nullable', 'url']]);

        if (DB::table('boardgames')->where('name','=', $request->name)->exists()) {
            $game = DB::table('boardgames')->where('name','=', $request->name)->get();
//            dd($game);
            $user->boardgames()->attach($game[0]->id);
            $user->boardgames()->updateExistingPivot($game[0]->id, $imageUrl);

        } else {
            $gameName = $request->validate([
                'name' => ['required', 'string']
            ]);

            $newGame = Boardgame::create(array_filter($gameName));
//            dd($newGame);
            $user->boardgames()->attach($newGame->id);
            $user->boardgames()->updateExistingPivot($newGame->id, $imageUrl);

            if ($request['favourite'])
            {
                $user->boardgames()->updateExistingPivot($newGame->id, ['favourite' => 1]);
            }

        }
        return to_route('boardgames.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):View
    {
        $boardgame = Boardgame::find($id);
        $users = $boardgame->users;
        $currentUser = Auth::user();
        $gameUserInfo = $currentUser->boardgames()->where('boardgame_id', $id)->first()->pivot;
        $publicComments = Comment::where('boardgame_id', $id)->where('public', 1)->orderByDesc('created_at')->get();
        $userComments = Comment::where('boardgame_id', $id)->where('user_id', $currentUser->id)->orderByDesc('created_at')->get();
//        dd($gameUserInfo);
        return view('boardgames.show',
            [
                'boardgame' => $boardgame,
                'gameUserInfo' => $gameUserInfo,
                'users'=>$users,
                'publicComments'=>$publicComments,
                'userComments'=>$userComments
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $boardgame = Boardgame::find($id);
        $currentUser = Auth::user();
        $gameUserInfo = $currentUser->boardgames()->where('boardgame_id', $id)->first()->pivot;
//        dd($gameUserInfo);
        return view('boardgames.edit', ['boardgame' => $boardgame, 'gameUserInfo' => $gameUserInfo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $game = Boardgame::find($id);
        $imageUrl = $request->validate([
            'imageurl' => ['string', 'nullable', 'url']
        ]);
//        $game->update(array_filter($data));
        $name = $request->validate([
            'name' => ['string']
        ]);

        $currentUser = Auth::user();
        $currentUser->boardgames()->updateExistingPivot($id, ['custom_name' => $request['name']]);
        $currentUser->boardgames()->updateExistingPivot($id, ['favourite' => $request['favourite'] ? $request['favourite'] : 0]);
        $currentUser->boardgames()->updateExistingPivot($id, $imageUrl);

        return to_route('boardgames.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $user->boardgames()->detach($id);
//        $deleted = DB::table('boardgames')->where('id', '=', $id)->delete();

        return to_route('boardgames.index');
    }

    //display all the boardgames currently in the boardgame table
    public function allGames() {
        $allGames = Boardgame::query()->get();
        $allBoardgameUsers = BoardgameUser::query()->get();
        return view('boardgames.allgames', ['allGames' => $allGames, 'allBoardgameUsers' => $allBoardgameUsers]);
    }

    //Display favourite games for logged in user
    public function favouriteGames() {
        $currentUser = Auth::user();
        $favouriteGames = $currentUser->boardgames()->wherePivotIn('favourite', [1, 'on'])->get();
        return view('boardgames.favourites', ['favouriteGames' => $favouriteGames]);
    }

    //Controller for favourite star button on index page
    public function updateFave(string $id) {
        $currentUser = Auth::user();
        $currentFaveStatus = $currentUser->boardgames()->where('boardgame_id', $id)->first()->pivot->favourite;
        $currentUser->boardgames()->updateExistingPivot($id,['favourite' => $currentFaveStatus ? 0 : 1] );
//        return to_route('boardgames.index');
        return back();
    }

}
