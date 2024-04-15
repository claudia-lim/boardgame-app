import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
function Favourites({user, favouriteGames}) {
    console.log('favourite games', favouriteGames);
    return (
        <>
            <AppLayout header="Favourites - React" user={user}>
                <div>Favourite games</div>
            </AppLayout>
        </>
    )
}

export default Favourites;
