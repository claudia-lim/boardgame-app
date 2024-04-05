
<h2>
    Add comment to {{ ucwords($game->name) }}
</h2>

<form method="POST" action="{{ route('comments.add', $boardgame_id) }}" class="add-comment-form">
    @csrf
            <div class="comments-input-div">
                <label for="comment">Add a comment</label>
                <textarea id="comment" name="comment"></textarea>
            </div>
    <div class="public-comment-input-div">
        <p>Make comment public?</p>
        <label for="yes">Yes</label>
        <input id="yes" name="public" type="radio" value="yes" >
        <label for="no">No</label>
        <input id="no" name="public" type="radio" value="no" >

    </div>
            <div>
                <button type="submit">Add comment</button>
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
