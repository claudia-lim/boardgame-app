<x-gameapplayout>

    <h1>All games currently in boardgames table:</h1>
        @foreach($allGames as $game)
            <div>

            {{ $game['id'] }} : {{ $game['name'] }}
            </div>

        @endforeach
    <h1>All board game user records</h1>
    @foreach($allBoardgameUsers as $boardgameUser)
        <div>
            <h2>User ID: {{ $boardgameUser['user_id'] }}</h2>
            <p>Game ID: {{ $boardgameUser['boardgame_id'] }}</p>
            <p>imageURL: {{ $boardgameUser['imageUrl'] }}</p>
        </div>
    @endforeach
</x-gameapplayout>

