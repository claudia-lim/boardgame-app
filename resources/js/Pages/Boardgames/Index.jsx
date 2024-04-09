import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
const index = ({boardgames, user}) => {
    const games = boardgames.map((boardgame) => {
        return (
            <section className="index-game-section">
                <h2>{boardgame.pivot.custom_name ? boardgame.pivot.custom_name : boardgame.name}</h2>
                <div className="index-game-section-images">
                    <img className="index-game-image" alt="boardgame image"
                         src={boardgame.pivot.imageUrl ? boardgame.pivot.imageUrl : boardgame.imageurl}/>
                    <div className="fave-icon">
                    </div>
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
