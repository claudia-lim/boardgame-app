<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ReactController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\BoardgameController;

//Route::get('/', [HomepageController::class, 'homepage'])->name('homepage');

 Route::get('/', function () {
     return Inertia::render('Welcome', [
         'canLogin' => Route::has('login'),
         'canRegister' => Route::has('register'),
         'laravelVersion' => Application::VERSION,
         'phpVersion' => PHP_VERSION,
     ]);
 });

Route::get('/dashboard', [ReactController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

//react pages
Route::get('/test', [ReactController::class, 'test'])->middleware(['auth', 'verified']);
Route::post('/test/upload', [ReactController::class, 'testFileUpload'])->middleware(['auth', 'verified'])->name('test.upload');
Route::get('/boardgames', [ReactController::class, 'index'])->middleware(['auth', 'verified'])->name('boardgames.index');
Route::get('/boardgames/create', [ReactController::class, 'create'])->middleware(['auth', 'verified'])->name('boardgames.create');
Route::post('/boardgames/store', [ReactController::class, 'store'])->middleware(['auth', 'verified'])->name('boardgames.store');
Route::get('/boardgames/{id}', [ReactController::class, 'show'])->middleware(['auth', 'verified'])->name('boardgames.show');
Route::get('/boardgames/{id}/edit', [ReactController::class, 'edit'])->middleware(['auth', 'verified'])->name('boardgames.edit');
Route::post('/boardgames/{id}/update', [ReactController::class, 'update'])->middleware(['auth', 'verified'])->name('boardgames.update');
Route::delete('/boardgames/{id}/destroy', [ReactController::class, 'destroy'])->middleware(['auth', 'verified'])->name('boardgames.destroy');
Route::get('/favourites', [ReactController::class, 'favouriteGames'])->middleware(['auth', 'verified'])->name('boardgames.favourites');

Route::patch('/updatefave/{id}', [ReactController::class, 'updateFave'])->middleware(['auth', 'verified'])->name('boardgames.updatefave');

Route::get('/boardgames/{id}/comments/public', [CommentController::class, 'showPublicComments'])->middleware(['auth', 'verified'])->name('boardgames.comments.public');
Route::get('/boardgames/{id}/comments/user', [CommentController::class, 'showUserComments'])->middleware(['auth', 'verified'])->name('boardgames.comments.user');

Route::get('/addcomment/{id}', [CommentController::class, 'create'])->middleware(['auth', 'verified'])->name('comments.create');
Route::post('/addcomment/{id}/add', [CommentController::class, 'addComment'])->middleware(['auth', 'verified'])->name('comments.add');
Route::delete('/comment/{id}/delete', [CommentController::class, 'deleteComment'])->middleware(['auth', 'verified'])->name('comments.delete');
Route::get('/comment/{id}/edit', [CommentController::class, 'editComment'])->middleware(['auth', 'verified'])->name('comments.edit');
Route::patch('/comment/{id}/update', [CommentController::class, 'updateComment'])->middleware(['auth', 'verified'])->name('comments.update');

Route::get('/allgames', [BoardgameController::class, 'allgames'])->middleware(['auth', 'verified'])->name('boardgames.allgames');
Route::delete('allgames/{id}/delete', [ReactController::class, 'deleteForever'])->middleware(['auth', 'verified'])->name('allgames.delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
