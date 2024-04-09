<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\BoardgameController;

Route::get('/', [HomepageController::class, 'homepage'])->name('homepage');
Route::get('/test', [\App\Http\Controllers\ReactController::class, 'test']);

Route::get('/boardgames', [BoardgameController::class, 'index'])->middleware(['auth', 'verified'])->name('boardgames.index');
Route::get('/boardgames/create', [BoardgameController::class, 'create'])->middleware(['auth', 'verified'])->name('boardgames.create');
Route::post('/boardgames/store', [BoardgameController::class, 'store'])->middleware(['auth', 'verified'])->name('boardgames.store');
Route::get('/boardgames/{id}', [BoardgameController::class, 'show'])->middleware(['auth', 'verified'])->name('boardgames.show');
Route::get('/boardgames/{id}/edit', [BoardgameController::class, 'edit'])->middleware(['auth', 'verified'])->name('boardgames.edit');
Route::patch('/boardgames/{id}/update', [BoardgameController::class, 'update'])->middleware(['auth', 'verified'])->name('boardgames.update');
Route::delete('/boardgames/{id}/destroy', [BoardgameController::class, 'destroy'])->middleware(['auth', 'verified'])->name('boardgames.destroy');

Route::get('/allgames', [BoardgameController::class, 'allgames'])->middleware(['auth', 'verified'])->name('boardgames.allgames');
Route::get('/favourites', [BoardgameController::class, 'favouriteGames'])->middleware(['auth', 'verified'])->name('boardgames.favourites');
Route::patch('/boardgames/{id}/updatefave', [BoardgameController::class, 'updateFave'])->middleware(['auth', 'verified'])->name('boardgames.updatefave');

Route::get('/addcomment/{id}', [CommentController::class, 'create'])->middleware(['auth', 'verified'])->name('comments.create');
Route::post('/addcomment/{id}/add', [CommentController::class, 'addComment'])->middleware(['auth', 'verified'])->name('comments.add');
Route::delete('/addcomment/{id}/delete', [CommentController::class, 'deleteComment'])->middleware(['auth', 'verified'])->name('comments.delete');


//From Laravel Breeze:
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [BoardgameController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
