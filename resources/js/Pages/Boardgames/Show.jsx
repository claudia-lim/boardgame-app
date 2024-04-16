import React, {useEffect, useState} from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
import {Link} from "@inertiajs/react";
import DeleteGameButton from "../Components/DeleteGameButton.jsx";
import FavouriteButton from "@/Pages/Components/FavouriteButton.jsx";
import CommentsDisplay from "@/Pages/Components/CommentsDisplay.jsx";
function Show({user, boardgame, gameUserInfo, publicComments, userComments}) {
    // console.log(boardgame);
    const [commentsToDisplay, setCommentsToDisplay] = useState(publicComments);
    const [currentCommentsDisplay, setCurrentCommentsDisplay] = useState('Public');
    function toggleComments () {
        if (commentsToDisplay === publicComments) {
            setCommentsToDisplay(userComments)
            setCurrentCommentsDisplay('User')
        } else {
            setCommentsToDisplay(publicComments);
            setCurrentCommentsDisplay('Public')
        }
    }
    return (
        <>
            <AppLayout header={gameUserInfo['custom_name'] ? gameUserInfo['custom_name'] : boardgame.name} user={user}>
                <main className='show-game'>
                <div>
                    <img className="index-game-image" src={ gameUserInfo.imageUrl ? gameUserInfo.imageUrl : boardgame.imageurl}/>
                </div>
                <FavouriteButton favourite={gameUserInfo.favourite} boardgame={boardgame}/>
                <Link as="button" href={route('boardgames.edit', boardgame.id)}>Edit Game</Link>
                <DeleteGameButton boardgame={boardgame}/>
                <section id='comments'>
                    <a href={route('comments.create', boardgame.id)}><button className='comment-button'>Add a Comment</button></a>
                    <button className='comment-button' onClick={toggleComments} >Toggle Comments: public/user</button>
                    <h3 className='comments-subheading'>{currentCommentsDisplay} Comments</h3>
                    <CommentsDisplay comments={commentsToDisplay} user={user} />
                </section>

                </main>
            </AppLayout>
        </>
    )
}

export default Show;
