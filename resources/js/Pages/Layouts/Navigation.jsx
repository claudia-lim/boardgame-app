import React from 'react';
import { Link } from '@inertiajs/react'
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.jsx";

function Navigation({user}) {
    return (
        <>
        <nav className="navigation">

            <div className="main-links">


                <div>
                    <Link href="/dashboard">Dashboard</Link>
                </div>
                <div>
                    <Link href="/boardgames">Your Collection</Link>
                </div>
                <div>
                    <Link href="/favourites">Favourites</Link>
                </div>

                <div>
                    <Link href="/boardgames/create">
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

                <div>
                    <Link href={route('logout')} method="post">Log Out</Link>
                </div>
                </div>



        </nav>
</>
)
}

export default Navigation;
