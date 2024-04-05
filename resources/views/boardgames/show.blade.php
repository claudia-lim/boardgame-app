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
            <button class="toggle-comments">Your comments/Public commments</button>
            <div class="public-comments hidden">
                <h4>Public Comments</h4>
                @foreach($publicComments as $publicComment)
                <div class="comment public-comment {{ $publicComment->public ? 'public' : 'private' }}">
                    <h5> {{ $publicComment->comment }} </h5>
                    <p>Comment posted at: {{ $publicComment->created_at }}</p>
{{--                    <p>user id = {{ $comment->user_id }}</p>--}}
                    <p>By User: {{ $publicComment->user($publicComment->user_id)->name }}</p>
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
                <h4>User Comments</h4>
                @foreach($userComments as $userComment)
                    <div class="comment user-comment {{ $userComment->public ? 'public' : 'private' }}">
                        <h5> {{ $userComment->comment }} </h5>
                        <p>Comment posted at: {{ $userComment->created_at }}</p>
                        {{--                    <p>user id = {{ $comment->user_id }}</p>--}}
                        <p>By User: {{ $userComment->user($userComment->user_id)->name }}</p>
                        <p> {{ $userComment->public ? 'Public post' : 'Private post' }}</p>
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
