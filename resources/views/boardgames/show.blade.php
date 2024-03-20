@include('layouts.navigation')
<h1>{{ $game->name }}</h1>
<div>
    <img style="height:20vw" src='{{ $game->imageurl }}'>
</div>
<a href="{{ route('boardgames.edit', $game) }}"><button>Edit</button></a>

<form method="POST" action="{{ route('boardgames.destroy', $game) }}">
    @csrf
    @method('delete')
    <button type="submit">Delete</button>
</form>


