import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
function Show({user, boardgame, gameUserInfo, publicComments, userComments}) {
    return (
        <>
            <AppLayout header="show individual game" user={user}>
                <div>Game info</div>
                <h2>{boardgame.name}</h2>

            </AppLayout>
        </>
    )
}

export default Show;
