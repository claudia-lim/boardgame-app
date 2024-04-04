{{--@include('layouts.navigation')--}}
<x-gameapplayout>
    <div>
        <x-slot name="header">
            {{ ucwords($boardgame->name) }} to be edited
        </x-slot>
        <form method="POST" action="{{ route('boardgames.update', $boardgame) }}" class="edit-game-form">
            @csrf
            @method('patch')

            <div class="gamename-input-div">
                <label for="input-gamename">Name: </label>
                <input id="input-gamename" name="name" type="text" value="{{ ucwords($boardgame->name) }}">
            </div>
            <div class="image-url-input-div">
                <label for="imageurl">Image URL:</label>
                <input id="imageurl" name="imageurl" type="text" >
            </div>
            <div class="favourite-input-div">
                <label for="favourite">Favourite?</label>
                <input id="favourite" name="favourite" type="checkbox" {{ $gameUserInfo->favourite ? 'checked="checked"' : "none" }} >
            </div>
{{--            <div class="comments-input-div">--}}
{{--                <label for="comments">Comments</label>--}}
{{--                <textarea id="comments" name="comments">{{ $gameUserInfo->comments }}</textarea>--}}
{{--            </div>--}}
            <div>
                <button type="submit">Update</button>
            </div>
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
