<x-gameapplayout>
    <x-slot name="header">
    Game: {{$gameUserInfo->custom_name ? ucwords($gameUserInfo->custom_name) : ucwords($boardgame->name) }}

    </x-slot>
{{--    <h2>Current user: {{ Auth::user()->id }}</h2>--}}

{{--    <i class="fa-{{$gameUserInfo->favourite ? 'solid' : 'regular'}} fa-star"></i>--}}
<div class="show-game">
    <div class="show-in-collection-of">
        <h4>In the collection of:</h4>
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    </div>
    <div>
        <img class="index-game-image" src='{{ $boardgame->imageurl }}'>
    </div>
    <div class="fave-icon">
        <form method="POST" action="{{ route('boardgames.updatefave', $boardgame) }}">
            @csrf
            @method('patch')
            <button class="fave-button" type="submit">
                <i class="fa-{{$gameUserInfo->favourite ? 'solid' : 'regular'}} fa-star fave-toggle-icon"></i>
            </button>
        </form>
    </div>
        <section class="comments">
            <button class="toggle-comments">Display Public Comments</button>
            <div class="public-comments hidden">
                <h4>All Public Comments</h4>
                @if ($publicComments->isEmpty())
                    <p>No comments yet</p>
                @endif
                @foreach($publicComments as $publicComment)
                <div class="comment public-comment {{ $publicComment->public ? 'public' : 'private' }}">
                    <p> {{ $publicComment->comment }} </p>
                    <h6>Comment posted at: {{ $publicComment->created_at->format("H:i d M Y") }}</h6>
                    <h6>By User: {{ $publicComment->user($publicComment->user_id)->name }}</h6>
                    <form method="POST" action="{{route('comments.delete', $publicComment->id)}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="{{ $publicComment->user_id == Auth::user()->id ? '' : 'hidden'}}">Delete</button>
                    </form>
                </div>
                @endforeach
{{--            {{ $publicComments->links() }}--}}
            </div>

            <div class="user-comments">
                <h4>Your Comments</h4>
                @if ($userComments->isEmpty())
                    <p>No comments yet</p>
                @endif
                @foreach($userComments as $userComment)
                    <div class="comment user-comment {{ $userComment->public ? 'public' : 'private' }}">
                        <p> {{ $userComment->comment }} </p>
                        <h6>Comment posted at: {{ $userComment->created_at->format("H:i d M Y") }}</h6>
                        <h6>By User: {{ $userComment->user($userComment->user_id)->name }}</h6>
                        <h6> {{ $userComment->public ? 'Public post' : 'Private post' }}</h6>
                        <form method="POST" action="{{route('comments.delete', $userComment->id)}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="{{ $userComment->user_id == Auth::user()->id ? '' : 'hidden'}}">Delete</button>
                        </form>
                    </div>

                @endforeach
{{--            {{ $userComments->links() }}--}}
            </div>
        </section>

    <a href="{{ route('boardgames.edit', $boardgame) }}">
        <button>Edit</button>
    </a>

    <a href="{{ route('comments.create', $boardgame) }}">
        <button>Add comment</button>
    </a>

    <form method="POST" action="{{ route('boardgames.destroy', $boardgame) }}">
        @csrf
        @method('delete')
        <button type="submit">Remove from Collection</button>
    </form>
</div>

</x-gameapplayout>
