<h1>{{ $game->name }}</h1>
<div>
    <img style="height:20vw" src='{{ $game->imageurl }}'>
</div>
<a href="{{ route('boardgames.edit', $game) }}"><button>Edit</button></a>

