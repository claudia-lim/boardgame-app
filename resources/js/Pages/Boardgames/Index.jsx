import React, {useState} from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
import {Link} from "@inertiajs/react";
import DeleteGameButton from "../Components/DeleteGameButton.jsx";
import FavouriteButton from "@/Pages/Components/FavouriteButton.jsx";

function index ({auth, boardgames, user}) {

    const games = boardgames.map((boardgame) => {

        return (
            <section className="index-game-section" key={boardgame.id}>
                <div className='game-name-section'>
                    <h2 className='game-name'>{boardgame.pivot.custom_name ? `${boardgame.pivot.custom_name}*` : boardgame.name}</h2>
                    {boardgame.pivot.custom_name ? <p className='game-name'>* AKA {boardgame.name}</p> : '' }
                </div>
                <div className="index-game-section-images">
                    <img className="index-game-image" alt="boardgame image"
                         src={boardgame.pivot.imageUrl ? boardgame.pivot.imageUrl : `/storage/${auth.defaultImage}`}/>
                    <div className="fave-icon">
                        <FavouriteButton boardgame={boardgame} favourite={boardgame.pivot.favourite}/>
                    </div>
                </div>
                <div className="index-game-section-buttons">
                    <Link as='button' href={route('boardgames.show', boardgame.id)}>Show</Link>
                    <Link as="button" href={route('boardgames.edit', boardgame.id)}>Edit</Link>
                    <DeleteGameButton boardgame={boardgame}/>
                </div>
            </section>
    )
    });

    return (
        <AppLayout header="Your Game Collection" user={user}>

            <main className="index-games-display">
                {games}
            </main>

        </AppLayout>
    )
}

export default index;
