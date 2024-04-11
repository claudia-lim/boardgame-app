import React from 'react';
import {router} from "@inertiajs/react";

function DeleteGameButton({boardgame}) {

    function handleSubmit(e) {
        e.preventDefault()
        router.delete(route('boardgames.destroy', boardgame.id))
    }
    return (
        <form onSubmit={handleSubmit}>
            <button type="submit">Remove from Collection</button>
        </form>
    )
}

export default DeleteGameButton;
