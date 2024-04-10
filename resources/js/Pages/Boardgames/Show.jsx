import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
function Show({user, boardgame, gameUserInfo, publicComments, userComments}) {
    return (
        <>
            <AppLayout header="show individual game" user={user}>
                <div>
                    Board game 'official' name:
                    <h2>{boardgame.name}</h2>
                    User's custom name:
                    <h2>{gameUserInfo['custom_name']}</h2>
                </div>
            </AppLayout>
        </>
    )
}

export default Show;
