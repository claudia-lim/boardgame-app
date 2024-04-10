import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
function Favourite({user}) {
    return (
        <>
            <AppLayout header="Favourites - React" user={user}>
                <div>Favourite games</div>
            </AppLayout>
        </>
    )
}

export default Favourite;
