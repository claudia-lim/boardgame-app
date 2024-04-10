import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
function Edit({user, boardgame, gameUserInfo}) {
    return (
        <>
            <AppLayout header="edit individual game" user={user}>
                <div>Game info</div>
                <h2>{boardgame.name}</h2>

            </AppLayout>
        </>
    )
}

export default Edit;
