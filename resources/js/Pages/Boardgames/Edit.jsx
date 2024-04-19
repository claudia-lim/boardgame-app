import React, {useState} from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
import {router} from "@inertiajs/react";
import DeleteGameButton from "../Components/DeleteGameButton.jsx";
function Edit({user, boardgame, gameUserInfo}) {

    const startingName = gameUserInfo['custom_name'] ? gameUserInfo['custom_name'] : boardgame.name;

    const [data, setData] = useState({
        name: startingName,
        imageUrl: gameUserInfo.imageUrl,
        favourite: gameUserInfo.favourite
    })
    function handleChange(e) {
        const key = e.target.id;
        const value = e.target.value
        setData(data => ({
            ...data,
            [key]: value,
        }))
    }

    function handleCheckbox(e) {
        const key = e.target.id;
        const value = e.target.checked;
        setData(data=> ({
            ...data,
            [key]:value,
        }))
    }
    function handleSubmit(e) {
        e.preventDefault()
        router.patch(route('boardgames.update', boardgame.id), data)
    }

    return (
        <>
            <AppLayout header={`Edit: ${boardgame.name}`} user={user}>
                <div>Game info</div>
                <h2>{boardgame.name}</h2>

                <form onSubmit={handleSubmit} className="edit-game-form">

                    <div className="gamename-input-div">
                        <label htmlFor="input-gamename">Name: </label>
                        <input onChange={handleChange}
                               id="name"
                               type="text"
                               value={data.name}/>
                    </div>
                    <div className="image-url-input-div">
                        <label htmlFor="imageUrl">Image URL:</label>
                        <input onChange={handleChange}
                               id="imageUrl"
                               name="imageUrl"
                               type="text"
                               value={data.imageUrl}
                               placeholder="If left blank, default image will be used"/>
                    </div>
                    <div className="favourite-input-div">
                        <label htmlFor="favourite">Favourite?</label>
                        <input id="favourite"
                               onChange={handleCheckbox}
                               name="favourite"
                               checked={data.favourite}
                               type="checkbox"/>
                    </div>
                    <div className='buttons-div'>
                        <button type="submit">Update</button>
                        <a href={route('boardgames.show', boardgame.id)}>
                            <button type='button'>
                            Cancel
                            </button>
                        </a>
                    </div>
                <DeleteGameButton boardgame={boardgame}/>
                </form>

                {/*<button onClick={checkdata}>Check</button>*/}
            </AppLayout>
        </>
    )
}

export default Edit;
