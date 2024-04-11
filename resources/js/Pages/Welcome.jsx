import { Link, Head } from '@inertiajs/react';
import Guest from "@/Layouts/GuestLayout.jsx";

export default function Welcome({ auth }) {

    return (
        <Guest header="Welcome To The Board Game App">
            <Head title="Welcome" />

                            <nav className="">
                                {auth.user ? (
                                    <Link as="button"
                                        href={route('dashboard')}
                                        className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link as="button"
                                            href={route('login')}
                                            className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Log in
                                        </Link>
                                        <Link as="button"
                                            href={route('register')}
                                            className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </Link>
                                    </>
                                )}
                            </nav>


                        <main className="">
<h3>Claud's Board Game App Project</h3>
                            <p>Current features:</p>
                            <ul>
                                <li>Add a board game to your collection</li>
                                <li>Tag if a game is a 'favourite' in your collection</li>
                                <li>Edit or remove board games in your collection</li>
                                <li>Add comments (public or private comments) to each board game. See your comments, or public comments with each board game</li>
                            </ul>
                        </main>
        </Guest>
    );
}
