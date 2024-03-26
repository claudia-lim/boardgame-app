<x-gameapplayout>

    <h1>All games currently in boardgames table:</h1>
        @foreach($allGames as $game)
            <div>

            {{ $game['id'] }} : {{ $game['name'] }}
            </div>

        @endforeach
</x-gameapplayout>

