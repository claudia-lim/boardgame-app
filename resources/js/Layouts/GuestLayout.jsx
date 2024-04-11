import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';
import Navigation from "@/Pages/Layouts/Navigation.jsx";

export default function Guest({ header, children }) {
    return (
        <>
            <header className="header">
                <h1>{header}</h1>
            </header>
            <main>
                {children}
            </main>
        </>
    );
}
