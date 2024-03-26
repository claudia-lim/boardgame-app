{{--@include('layouts.navigation')--}}
<x-gameapplayout>
    <x-slot name="header">
    Game: {{ ucwords($boardgame->name) }}

    </x-slot>
    <h2>Current user: {{ Auth::user()->id }}</h2>

    {{--<p>{{ $link->getBoardgameUserInfo(Auth::user()->id, $boardgame->id) }}</p>--}}
{{--    <h2>{{ $gameUserInfo->favourite ? 'Favourite' : 'Not Favourited'}}</h2>--}}
    <i class="fa-{{$gameUserInfo->favourite ? 'solid' : 'regular'}} fa-star"></i>

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
</x-gameapplayout>



