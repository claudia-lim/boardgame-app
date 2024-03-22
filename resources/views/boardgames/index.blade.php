
@include('layouts.navigation')

    <header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Displaying boardgames') }}
        </h2>
    <header>
<div>
    <div>
        <a href="{{ route('boardgames.create')}}"><button>Add New Game to Your Collection</button></a>
    </div>

    <h2>User: {{ Auth::user()->name }}</h2>

    @foreach($boardgames as $boardgame)
        <div style="background-color: #eeeecf">
            <h2>{{ $boardgame->name }}</h2>
            <div>
            @if($boardgame->imageurl)
                <img alt="boardgame image" style="width:20vw" src="{{ $boardgame->imageurl}}">
            @endif
                <div>
                    <a href="{{ route('boardgames.show', $boardgame) }}"><button>Show</button></a>
                </div>
                <div>
                    <a href="{{ route('boardgames.edit', $boardgame) }}"><button>Edit</button></a>
                </div>
                <form method="POST" action="{{ route('boardgames.destroy', $boardgame) }}">
                    @csrf
                    @method('delete')
                    <button type="submit">Remove from Collection</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
