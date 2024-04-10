import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
import {Link} from "@inertiajs/react";
import DeleteGameButton from "../Components/DeleteGameButton.jsx";
function Show({user, boardgame, gameUserInfo, publicComments, userComments}) {
    console.log(boardgame);
    return (
        <>
            <AppLayout header="show individual game" user={user}>
                <div>
                    Board game 'official' name:
                    <h2>{boardgame.name}</h2>
                    User's custom name:
                    <h2>{gameUserInfo['custom_name']}</h2>
                </div>
                <div>
                    <img className="index-game-image" src={ gameUserInfo.imageUrl ? gameUserInfo.imageUrl : boardgame.imageurl}/>
                </div>
                <Link as="button" href={`/test/boardgames/${boardgame.id}/edit`}>Edit</Link>
                <DeleteGameButton boardgame={boardgame} />
            </AppLayout>
        </>
    )
}

export default Show;
