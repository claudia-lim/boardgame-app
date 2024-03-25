<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
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
        $user = Auth::user();
        $request['name'] = trim($request['name']);
        $request['name'] = strtolower($request['name']);

        if (DB::table('boardgames')->where('name','=', $request->name)->exists()) {
            $game = DB::table('boardgames')->where('name','=', $request->name)->get();
//            dd($game);
            $user->boardgames()->attach($game[0]->id);

        } else {
            $data = $request->validate([
                'name' => ['required', 'string'],
                'imageurl' => ['string', 'nullable', 'url']
            ]);

            $newGame = Boardgame::create(array_filter($data));
            $user->boardgames()->attach($newGame->id);
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
        return view('boardgames.show', ['boardgame' => $boardgame, 'users'=>$users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $boardgame = Boardgame::find($id);
        return view('boardgames.edit', ['boardgame' => $boardgame]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $game = Boardgame::find($id);
        $data = $request->validate([
            'name' => ['required', 'string'],
            'imageurl' => ['string', 'nullable', 'url']

        ]);
        $game->update(array_filter($data));
        return to_route('boardgames.index');
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
}
