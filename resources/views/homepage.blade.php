<x-gameapp-guestlayout>
    <!-- Page Heading -->
        <x-slot name="header">
                {{ __('The Board Game App') }}
        </x-slot>

    <!-- Page Content -->
        <div>
            @if (Route::has('login'))
                <nav>
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>

</x-gameapp-guestlayout>
