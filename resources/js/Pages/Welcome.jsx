import { Link, Head } from '@inertiajs/react';
import Guest from "@/Layouts/GuestLayout.jsx";

export default function Welcome({ auth }) {

    return (
        <Guest header="Welcome To The Board Game App">
            <Head title="Welcome" />

                            <nav className='welcome-nav'>
                                {auth.user ? (
                                    <Link as="button"
                                        href={route('dashboard')}
                                    >
                                        Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link as="button"
                                            href={route('login')}
                                        >
                                            Log in
                                        </Link>
                                        <Link as="button"
                                            href={route('register')}
                                        >
                                            Register
                                        </Link>
                                    </>
                                )}
                            </nav>


                        <main className='welcome-main'>
<h3>Claud's Board Game App Project</h3>
                            <p>Current features:</p>
                            <ul>
                                <li>Add a board game to your collection</li>
                                <li>Tag if a game is a 'favourite' in your collection</li>
                                <li>Edit or remove board games in your collection</li>
                                <li>Add comments (public or private comments) to each board game. Toggle between all public comments or your own comments with each board game</li>
                            </ul>
                        </main>
        </Guest>
    );
}
