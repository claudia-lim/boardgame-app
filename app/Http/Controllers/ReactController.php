<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ReactController extends Controller
{
    public function test() {
        return Inertia::render('Test');
    }
}
