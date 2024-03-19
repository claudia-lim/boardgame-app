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
        return view('boardgames.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Boardgame $boardgame):View
    {
        return view('boardgames.show', ['boardgame' => $boardgame]);
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
