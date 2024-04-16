import React, {useEffect, useState} from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
import {Link} from "@inertiajs/react";
import DeleteGameButton from "../Components/DeleteGameButton.jsx";
import FavouriteButton from "@/Pages/Components/FavouriteButton.jsx";
import CommentsDisplay from "@/Pages/Components/CommentsDisplay.jsx";
function Show({user, boardgame, gameUserInfo, publicComments, userComments}) {
    // console.log(boardgame);
    const [commentsToDisplay, setCommentsToDisplay] = useState(publicComments);
    const [currentCommentsDisplay, setCurrentCommentsDisplay] = useState('Public comments');
    function toggleComments () {
        if (commentsToDisplay === publicComments) {
            setCommentsToDisplay(userComments)
            setCurrentCommentsDisplay('User comments')
        } else {
            setCommentsToDisplay(publicComments);
            setCurrentCommentsDisplay('Public comments')
        }
    }
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
                <FavouriteButton favourite={gameUserInfo.favourite} boardgame={boardgame}/>
                <div>
                    <a href={route('comments.create', boardgame.id)}><button>Add a Comment</button></a>
                    <button onClick={toggleComments}>Toggle Comments: public/user</button>
                    <h6>{currentCommentsDisplay}</h6>
                    <CommentsDisplay comments={commentsToDisplay} />
                </div>
                <Link as="button" href={route('boardgames.edit', boardgame.id)}>Edit</Link>
                <DeleteGameButton boardgame={boardgame} />
            </AppLayout>
        </>
    )
}

export default Show;
