
@include('layouts.navigation')
<h1>Display all boardgames</h1>
<div>
    <div>
        <a href="{{ route('boardgames.create') }}"><button>Add New Game</button></a>
    </div>

    <h2>User: {{ Auth::user()->name }}</h2>

    @foreach($boardgames as $boardgame)
        <div>
            <h2>{{ $boardgame->name }}</h2>
            @if($boardgame->imageurl)
                <img alt="boardgame image" style="width:20vw" src="{{ $boardgame->imageurl}}">
            @endif
            <div>
                <a href="{{ route('boardgames.show', $boardgame) }}"><button>Show</button></a>
                <a href="{{ route('boardgames.edit', $boardgame) }}"><button>Edit</button></a>
                <form method="POST" action="{{ route('boardgames.destroy', $boardgame) }}">
                    @csrf
                    @method('delete')
                    <button type="submit">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

