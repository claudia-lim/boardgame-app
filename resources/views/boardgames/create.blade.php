{{--@include('layouts.navigation')--}}
<x-gameapplayout>
    <x-slot name="header">

        {{ __('Add a Game to Collection') }}
    </x-slot>
    <div >

        <form method="POST" action="{{ route('boardgames.store') }}" class="add-game-form">
            @csrf
            <div class="gamename-input-div">
                <label for="input-gamename">Name: </label>
                <input id="input-gamename" name="name" type="text">
            </div>
            <div class="image-url-input-div">
                <label for="imageurl">Image URL:</label>
                <input id="imageurl" name="imageurl" type="text" >
            </div>
            <div class="favourite-input-div">
                <label for="favourite">Favourite?</label>
                <input id="favourite" name="favourite" type="checkbox">
            </div>
            <div class="comments-input-div">
                <label for="comments">Add a comment:</label>
                <textarea id="comments" name="comments"></textarea>
            </div>
            <div>
                <button type="submit">Add</button>
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
