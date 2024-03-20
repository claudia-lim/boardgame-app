<div>
    <p>{{ $game->name }} to be edited</p>
    <form method="POST" action="{{ route('boardgames.update', $game) }}">
        @csrf
        @method('patch')
        <label for="input-gamename">Name</label>
        <input id="input-gamename" name="name" type="text" value="{{ $game->name }}">
        <label for="imageurl">Image URL:</label>
        <input id="imageurl" name="imageurl" type="text">
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
