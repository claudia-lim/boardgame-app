<x-gameapplayout>

    <x-slot name="header">
        {{ __('Favourite boardgames') }}
    </x-slot>

{{--    {{ dd($favouriteGames) }}--}}

    <div class="index-games-display">
        @if($favouriteGames->isEmpty())
            <h2>No games added to favourites yet!</h2>
        @endif
        @foreach($favouriteGames as $boardgame)
        <div class="index-game-section">
            <h2>{{ucwords($boardgame->name) }}</h2>

            <div class="index-game-section-images">
                @if($boardgame->imageurl)
                <img class="index-game-image"
                     alt="boardgame image"
                     src="{{ $boardgame->imageurl}}">
                @endif

                <i class="fa-{{$boardgame->pivot->favourite ? 'solid' : 'regular'}} fa-star fave-button"
                   data-fave="{{$boardgame->pivot->favourite ? '1' : '0'}}"></i>

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
