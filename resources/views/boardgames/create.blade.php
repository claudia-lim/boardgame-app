@include('layouts.navigation')
<h1>Add New Boardgame</h1>
<form method="POST" action="{{ route('boardgames.store') }}">
    @csrf
    <label for="input-gamename">Name</label>
    <input id="input-gamename" name="name" type="text">
    <label for="imageurl">Image URL:</label>
    <input id="imageurl" name="imageurl" type="text" >
    <label for="favourite">Favourite?</label>
    <input id="favourite" name="favourite" type="checkbox">

    <button type="submit">Add</button>
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
