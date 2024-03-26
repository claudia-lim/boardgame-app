{{--@include('layouts.navigation')--}}
<x-gameapplayout>
    <div>
        <x-slot name="header">
            {{ ucwords($boardgame->name) }} to be edited
        </x-slot>
        <form method="POST" action="{{ route('boardgames.update', $boardgame) }}">
            @csrf
            @method('patch')
            <label for="input-gamename">Name</label>
            <input id="input-gamename" name="name" type="text" value="{{ ucwords($boardgame->name) }}">
            <label for="imageurl">Image URL:</label>
            <input id="imageurl" name="imageurl" type="text">
            <label for="favourite">Favourite?</label>
            <input id="favourite" name="favourite" type="checkbox" {{ $gameUserInfo->favourite ? 'checked="checked"' : "none" }} >
            <button type="submit">Update</button>

        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-gameapplayout>
