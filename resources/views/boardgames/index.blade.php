
    <h1>Display all boardgames</h1>
<div>
    <p>Boardgame Info here</p>
    <div>
        <a href="{{ route('boardgames.create') }}"><button>Add New Game</button></a>
    </div>

    @foreach($boardgames as $boardgame)
        <div>
            <h2>{{ $boardgame->name }}</h2>
            <a href="{{ route('boardgames.show', $boardgame) }}"><button>Show</button></a>
            <a href="{{ route('boardgames.edit', $boardgame) }}"><button>Edit</button></a>
        </div>
    @endforeach
</div>

