<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Inertia\Inertia;
use Inertia\Response;
use function PHPUnit\Framework\isType;

class ReactController extends Controller
{
    public function test() {
        $user = Auth::user();
        return Inertia::render('Test', ['user'=>$user, 'url'=>'']);
    }

    public function testFileUpload(Request $request) {
        $file = $request->file('file');
        $path = $file->store('images', 'public');
        Log::info('path', [$path]);
        return $path;
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
        log::info($request);

//        Validate input
        $data = $request->validate([
            'imageurl' => ['file', 'nullable', 'image'],
            'name' => ['required', 'string'],
            'favourite' => ['boolean']
        ]);

        //save uploaded image
        if ($request['imageurl']) {
            $imageFile = $request->file('imageurl');
            log::info($imageFile);
            $path = $imageFile->store('images', 'public');
        } else {
            $path = '';
        }

        //Check if game already exists in board game table
        if (DB::table('boardgames')->where('name','=', $request['name'])->exists()) {
            $game = DB::table('boardgames')->where('name','=', $request['name'])->get();
            //Check that user doesn't already have link with this board game (ie already in collection), if not create link
            if (DB::table('boardgame_user')->where('user_id', '=', $user->id)->where('boardgame_id', '=', $game[0]->id)->doesntExist()) {
                $user->boardgames()->attach($game[0]->id);
                $user->boardgames()->updateExistingPivot($game[0]->id, ['imageUrl'=>$path]);
                $user->boardgames()->updateExistingPivot($game->id, ['favourite' => $data['favourite']]);
            } else {
                //Game is already in user's collection
                return back()->withErrors(['alreadyAdded'=>'Game is already in collection']);
            }
        } else {
            //If game doesn't already exist, add new game to board game table
            $newGame = Boardgame::create(['name'=>$data['name']]);
            //Link user to this board game (ie add to user's collection), with uploaded image if any
            $user->boardgames()->attach($newGame->id);
            $user->boardgames()->updateExistingPivot($newGame->id, ['imageUrl'=>$path]);
            $user->boardgames()->updateExistingPivot($newGame->id, ['favourite' => $data['favourite']]);

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
        log::info($request);
        $game = Boardgame::find($id);
        $currentUser = Auth::user();

        $imageUrl = $request->validate([
            'imageUrl' => ['file', 'image', 'nullable']
        ]);
        $name = $request->validate([
            'name' => ['required', 'string']
        ]);

        if (empty($request['imageUrl'])) {
            //Empty image url input means image is to be removed
            $currentUser->boardgames()->updateExistingPivot($id, ['imageUrl'=>'']);
            //Delete previous image
            $prevImage = $currentUser->boardgames()->where('boardgame_id', $id)->first()->pivot;
            $prevImageName = substr($prevImage->imageUrl, 7);
            Storage::disk('public')->delete('images/' . $prevImageName);
        } else if (!is_string($request['imageUrl'])) {
            //If image url input is not a string and not empty then it is a file to be uploaded
            $imageFile = $request->file('imageUrl');
            $path = $imageFile->store('images', 'public');
            $currentUser->boardgames()->updateExistingPivot($id, ['imageUrl'=>$path]);

            //Delete previous image
            $prevImage = $currentUser->boardgames()->where('boardgame_id', $id)->first()->pivot;
            $prevImageName = substr($prevImage->imageUrl, 7);
            Storage::disk('public')->delete('images/' . $prevImageName);
        } else {
            log::info('No change to current image');
        }

        if ($request['name'] !== $game->name) {
            //Game name inputted is different to the 'official' name in board games table
            //Update the custom name
            $currentUser->boardgames()->updateExistingPivot($id, ['custom_name' => $request['name']]);
        } else {
            //If is the same as 'official' name, then clear the custom name field
            $currentUser->boardgames()->updateExistingPivot($id, ['custom_name' => '']);
        }

        $currentUser->boardgames()->updateExistingPivot($id, ['favourite' => $request['favourite'] ? $request['favourite'] : 0]);

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
