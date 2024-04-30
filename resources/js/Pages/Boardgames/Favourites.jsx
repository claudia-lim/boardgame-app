import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
import FavouriteButton from "@/Pages/Components/FavouriteButton.jsx";
import {Link} from "@inertiajs/react";
import DeleteGameButton from "@/Pages/Components/DeleteGameButton.jsx";
function Favourites({user, favouriteGames, auth}) {
    const favouriteGamesDisplay = favouriteGames.map((boardgame) => {
        return (
            <section className="index-game-section" key={boardgame.id}>
                <h2 className='game-name'>{boardgame.pivot.custom_name ? `${boardgame.pivot.custom_name}*` : boardgame.name}</h2>
                {boardgame.pivot.custom_name ? <h6 className='game-name'>AKA {boardgame.name}</h6> : ''}
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
                    <DeleteGameButton boardgame={boardgame} />
                </div>
            </section>
        )
    });

    return (
        <>
            <AppLayout header="Favourite Games" user={user}>
                <main className="index-games-display">
                    {favouriteGamesDisplay}
                </main>
                <p>* Your custom name for this game</p>
            </AppLayout>
        </>
    )
}

export default Favourites;
