<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BoardgameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $boardgames = Boardgame::query()->get();
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
        $data = $request->validate([
            'name' => ['required', 'string'],
            'imageurl' => ['string']
        ]);
        $newGame = Boardgame::create($data);
        return to_route('boardgames.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):View
    {
        $game = Boardgame::find($id);
        return view('boardgames.show', ['game' => $game]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Boardgame $boardgame)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Boardgame $boardgame)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boardgame $boardgame)
    {
        //
    }
}
