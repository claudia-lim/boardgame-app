<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\BoardgameController;

Route::get('/', [HomepageController::class, 'homepage'])->name('homepage');

Route::get('/boardgames', [BoardgameController::class, 'index'])->name('boardgames.index');
Route::get('/boardgames/create', [BoardgameController::class, 'create'])->name('boardgames.create');
Route::post('/boardgames/store', [BoardgameController::class, 'store'])->name('boardgames.store');
Route::get('/boardgames/{id}', [BoardgameController::class, 'show'])->name('boardgames.show');
Route::get('boardgames/{id}/edit', [BoardgameController::class, 'edit'])->name('boardgames.edit');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
