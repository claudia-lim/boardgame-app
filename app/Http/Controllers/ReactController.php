<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
}
