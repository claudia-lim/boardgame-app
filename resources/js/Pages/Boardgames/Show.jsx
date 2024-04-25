import React, {useEffect, useState} from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
import {Link} from "@inertiajs/react";
import DeleteGameButton from "../Components/DeleteGameButton.jsx";
import FavouriteButton from "@/Pages/Components/FavouriteButton.jsx";
import CommentsDisplay from "@/Pages/Components/CommentsDisplay.jsx";
function Show({user, boardgame, gameUserInfo, auth}) {
    const [currentCommentsDisplay, setCurrentCommentsDisplay] = useState('public');
    function toggleComments () {
        if (currentCommentsDisplay === 'public') {
            setCurrentCommentsDisplay('user')
        } else {
            setCurrentCommentsDisplay('public')
        }
    }
    return (
        <>
            <AppLayout header={gameUserInfo['custom_name'] ? `${gameUserInfo['custom_name']} *` : boardgame.name} user={user}>
                <main className='show-game'>
                    {gameUserInfo['custom_name'] ? <p>* your custom name, official name is: <span className='game-name'>{boardgame.name}</span></p> : '' }
                    <div>
                        <img className="index-game-image" src={ gameUserInfo.imageUrl ? gameUserInfo.imageUrl : `/storage/${auth.defaultImage}`}/>
                    </div>
                    <FavouriteButton favourite={gameUserInfo.favourite} boardgame={boardgame}/>
                    <Link as="button" href={route('boardgames.edit', boardgame.id)}>Edit Game</Link>
                    <DeleteGameButton boardgame={boardgame}/>
                    <section id='comments-section'>
                        <a href={route('comments.create', boardgame.id)}><button className='comment-button'>Add a Comment</button></a>
                        <button className='comment-button' onClick={toggleComments} >Toggle Comments: public/user</button>
                        <h3 className='comments-subheading'>{currentCommentsDisplay === 'user' ? 'Your' : currentCommentsDisplay} Comments</h3>
                        <CommentsDisplay commentType={currentCommentsDisplay} user={user} boardgame={boardgame}/>
                    </section>
                </main>
            </AppLayout>
        </>
    )
}

export default Show;
