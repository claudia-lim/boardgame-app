<nav class="navigation">
    <!-- Primary Navigation Menu -->
    <div class="main-links">
                <!-- Navigation Links -->
                <div>
{{--                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">--}}
{{--                        {{ __('Dashboard') }}--}}
{{--                    </x-nav-link>--}}
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </div>
                <div>
{{--                    <x-nav-link :href="route('boardgames.index')" >--}}
{{--                        {{ __('Boardgames') }}--}}
{{--                    </x-nav-link>--}}
                    <a href="{{ route('boardgames.index') }}">Your Collection</a>
                </div>
                <div>
{{--                    <x-nav-link :href="route('boardgames.favourites')" >--}}
{{--                        {{ __('Favourites') }}--}}
{{--                    </x-nav-link>--}}
                    <a href="{{ route('boardgames.favourites') }}">Favourites</a>
                </div>

        <div>
            <a href="{{ route('boardgames.create')}}">
                Add New Game</a>
        </div>
    </div>

        <!-- Responsive Settings Options -->
        <div>
            <div>
                <div>{{ Auth::user()->name }}</div>
                <div>{{ Auth::user()->email }}</div>
            </div>

            <div class="">
{{--                <x-responsive-nav-link :href="route('profile.edit')">--}}
{{--                    {{ __('Profile') }}--}}
{{--                </x-responsive-nav-link>--}}
                <a href="{{ route('profile.edit') }}">Profile</a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
</nav>
