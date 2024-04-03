<x-gameapplayout>
    <x-slot name="header">
    Game: {{$gameUserInfo->custom_name ? ucwords($gameUserInfo->custom_name) : ucwords($boardgame->name) }}

    </x-slot>
{{--    <h2>Current user: {{ Auth::user()->id }}</h2>--}}

{{--    <i class="fa-{{$gameUserInfo->favourite ? 'solid' : 'regular'}} fa-star"></i>--}}
<div class="show-game">
    <div class="show-in-collection-of">
        <h4>In the collection of:</h4>
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    </div>
    <div>
        <img class="index-game-image" src='{{ $boardgame->imageurl }}'>
    </div>
    <div class="fave-icon">
        <form method="POST" action="{{ route('boardgames.updatefave', $boardgame) }}">
            @csrf
            @method('patch')
            <button class="fave-button" type="submit">
                <i class="fa-{{$gameUserInfo->favourite ? 'solid' : 'regular'}} fa-star fave-toggle-icon"></i>
            </button>
        </form>
    </div>
    <div>
        <div class="{{ $gameUserInfo->comments ? '' : 'hidden' }} comments">
            <h4>Comments</h4>
            <p>
                {{ $gameUserInfo->comments }}
            </p>

        </div>
    </div>
    <a href="{{ route('boardgames.edit', $boardgame) }}">
        <button>Edit</button>
    </a>

    <form method="POST" action="{{ route('boardgames.destroy', $boardgame) }}">
        @csrf
        @method('delete')
        <button type="submit">Remove from Collection</button>
    </form>
</div>

</x-gameapplayout>
