import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
import {Link} from "@inertiajs/react";
import DeleteGameButton from "../Components/DeleteGameButton.jsx";

function index ({boardgames, user}) {
    const games = boardgames.map((boardgame) => {
        return (
            <section className="index-game-section" key={boardgame.id}>
                <h2>{boardgame.pivot.custom_name ? boardgame.pivot.custom_name : boardgame.name}</h2>
                <div className="index-game-section-images">
                    <img className="index-game-image" alt="boardgame image"
                         src={boardgame.pivot.imageUrl ? boardgame.pivot.imageUrl : boardgame.imageurl}/>
                    <div className="fave-icon">
                        <h6>{boardgame.pivot.favourite? 'Favourite' : 'Not a favourite'}</h6>
                    </div>
                </div>
                <div className="index-game-section-buttons">
                    <Link as='button' href={route('boardgames.show', boardgame.id)}>Show</Link>
                    <Link as="button" href={route('boardgames.edit', boardgame.id)}>Edit</Link>
                    <DeleteGameButton boardgame={boardgame} />
                </div>
            </section>
    )
    });

    return (
        <AppLayout header="Your Collection - React component" user={user}>

            <div className="index-games-display">
                {games}
            </div>

        </AppLayout>
    )
}

export default index;
