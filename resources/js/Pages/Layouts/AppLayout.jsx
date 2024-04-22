import React from 'react';
import Navigation from "./Navigation.jsx";
function AppLayout({children, header, user}) {
    return (
        <>
            <Navigation user={user}/>
            <header className="header">
                <h1>{header}</h1>
            </header>
            <main>
                {children}
            </main>
        </>
    )
}

export default AppLayout;
