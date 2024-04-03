<x-gameapplayout>

    <x-slot name="header">
        {{ __('Your Board Game Collection') }}
    </x-slot>

<div>
    <div class="newgame-button-div">
        <a href="{{ route('boardgames.create')}}">
            <button class="newgame-button">Add New Game to Your Collection</button>
        </a>
    </div>

{{--    <h2>User: {{ Auth::user()->name }}</h2>--}}

    <div class="index-games-display">
    @foreach($boardgames as $boardgame)
        <section class="index-game-section">
            <h2>{{$boardgame->pivot->custom_name ? ucwords($boardgame->pivot->custom_name) : ucwords($boardgame->name) }}</h2>

            <div class="index-game-section-images">
                @if($boardgame->imageurl)
                    <img class="index-game-image" alt="boardgame image" src="{{ $boardgame->imageurl}}">
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
        </section>
    @endforeach
    </div>
</div>
</x-gameapplayout>
