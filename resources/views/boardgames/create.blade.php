<h1>Add New Boardgame</h1>
<form method="POST" action="{{ route('boardgames.store') }}">
    @csrf
    <label for="input-gamename">Name</label>
    <input id="input-gamename" name="name" type="text">
    <label for="imageurl">Image URL:</label>
    <input id="imageurl" name="imageurl" type="text">
    <button type="submit">Add</button>
</form>
