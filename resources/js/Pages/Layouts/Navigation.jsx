import React from 'react';
import { Link } from '@inertiajs/react'

function Navigation({user}) {
    return (
        <>
        <nav className="navigation">

            <div className="main-links">


                <div>
                    <Link href="/test/dashboard">Dashboard</Link>
                </div>
                <div>
                    <Link href="/test/boardgames">Your Collection</Link>
                </div>
                <div>
                    <Link href="/test/favourites">Favourites</Link>
                </div>

                <div>
                    <Link href="/test/boardgames/create">
                        Add New Game
                    </Link>
                </div>
            </div>

            <div>
                <div>
                    <div>{user.name}</div>
                    <div>{user.email}</div>
                </div>

                <div>
                    <Link href="/profile">Profile</Link>
                </div>

                {/*<div class="">*/}
                {/*    {{--                <x-responsive-nav-link :href="route('profile.edit')">--}}*/}
                {/*    {{--                    {{__('Profile')}}--}}*/}
                {/*    {{--                </x-responsive-nav-link>--}}*/}
                {/*    <a href="{{ route('profile.edit') }}">Profile</a>*/}

                {/*    <form method="POST" action="{{ route('logout') }}">*/}
                {/*        @csrf*/}

                {/*        <x-responsive-nav-link :href="route('logout')"*/}
                {/*        onclick="event.preventDefault();*/}
                {/*        this.closest('form').submit();">*/}
                {/*        {{__('Log Out')}}*/}
                {/*    </x-responsive-nav-link>*/}
                {/*</form>*/}
            </div>



        </nav>
</>
)
}

export default Navigation;
