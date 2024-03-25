@include('layouts.navigation')
<h1>Game: {{ ucwords($boardgame->name) }}</h1>
<h6>In the collection of
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>

</h6>
<div>
    <img style="height:20vw" src='{{ $boardgame->imageurl }}'>
</div>
<a href="{{ route('boardgames.edit', $boardgame) }}">
    <button>Edit</button>
</a>

<form method="POST" action="{{ route('boardgames.destroy', $boardgame) }}">
    @csrf
    @method('delete')
    <button type="submit">Remove from Collection</button>
</form>


