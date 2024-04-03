<x-gameapplayout>

    <x-slot name="header">
        {{ __('Favourite boardgames') }}
    </x-slot>

    <div class="index-games-display">
        @if($favouriteGames->isEmpty())
            <h2>No games added to favourites yet!</h2>
        @endif
        @foreach($favouriteGames as $boardgame)
        <div class="index-game-section">
            <h2>{{$boardgame->pivot->custom_name ? ucwords($boardgame->pivot->custom_name) : ucwords($boardgame->name) }}</h2>

            <div class="index-game-section-images">
                @if($boardgame->imageurl)
                <img class="index-game-image"
                     alt="boardgame image"
                     src="{{ $boardgame->imageurl}}">
                @endif

                    <div class="fave-icon">
                        <form method="POST" action="{{ route('boardgames.updatefave', $boardgame) }}">
                            @csrf
                            @method('patch')
                            <button class="fave-button" type="submit">
                                <i class="fa-{{$boardgame->pivot->favourite ? 'solid' : 'regular'}} fa-star fave-toggle-icon"></i>
                            </button>
                        </form>
                    </div>

            </div>

            <div class="index-game-section-buttons">
                <a href="{{ route('boardgames.show', $boardgame) }}"><button>Show</button></a>
                <a href="{{ route('boardgames.edit', $boardgame) }}"><button>Edit</button></a>
                <form method="POST" action="{{ route('boardgames.destroy', $boardgame) }}">
                    @csrf
                    @method('delete')
                    <button type="submit">Remove from Collection</button>
                </form>
            </div>

        </div>
        @endforeach
    </div>
</x-gameapplayout>
