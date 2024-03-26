
{{--@include('layouts.navigation')--}}
{{--<x-app-layout>--}}

<x-gameapplayout>


{{--    <header>--}}
        <x-slot name="header">
            {{ __('Displaying boardgames') }}
        </x-slot>
{{--    </header>--}}
<div>
    <div class="newgame-button-div">
        <a href="{{ route('boardgames.create')}}">
            <button class="newgame-button">Add New Game to Your Collection</button>
        </a>
    </div>

    <h2>User: {{ Auth::user()->name }}</h2>
    <div class="index-games-display">

    @foreach($boardgames as $boardgame)
        <div class="index-game-section">
            <h2>{{ucwords($boardgame->name) }}</h2>

            <div class="index-game-section-images">
                @if($boardgame->imageurl)
                    <img alt="boardgame image"
                         style="width:20vw"
                         src="{{ $boardgame->imageurl}}">
                @endif
{{--                    <i class="fa-solid fa-star"></i>--}}
{{--                    <i class="fa-regular fa-star"></i>--}}
                    <i class="fa-{{$boardgame->pivot->favourite ? 'solid' : 'regular'}} fa-star"></i>

{{--                    <img alt="favourite icon"--}}
{{--                         style="width: 10vw"--}}
{{--                         src={{$boardgame->pivot->favourite ? 'https://t4.ftcdn.net/jpg/05/40/09/17/360_F_540091788_AvDyNUSbtnKQfNccukuFa3ZlsHFnMYrK.png' : 'https://cdn3.iconfinder.com/data/icons/cosmo-color-education-1/40/rating_lowstar-512.png'}}>--}}
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
</div>
{{--</x-app-layout>--}}
</x-gameapplayout>
