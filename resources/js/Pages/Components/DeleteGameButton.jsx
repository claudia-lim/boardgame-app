import React from 'react';
import {router} from "@inertiajs/react";

function DeleteGameButton({boardgame}) {

    function handleSubmit(e) {
        e.preventDefault()
        router.delete(`/test/boardgames/${boardgame.id}/destroy`)
    }
    return (
        <form onSubmit={handleSubmit}>
            <button type="submit">Remove from Collection</button>
        </form>
    )
}

export default DeleteGameButton;
