<nav >
    <!-- Primary Navigation Menu -->
    <div>
        <div>
            <div>
                <!-- Navigation Links -->
                <div>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                <div>
                    <x-nav-link :href="route('boardgames.index')" >
                        {{ __('Boardgames') }}
                    </x-nav-link>
                </div>
                <div>
                    <x-nav-link :href="route('boardgames.favourites')" >
                        {{ __('Favourites') }}
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>

        <!-- Responsive Settings Options -->
        <div>
            <div>
                <div>{{ Auth::user()->name }}</div>
                <div>{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

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
