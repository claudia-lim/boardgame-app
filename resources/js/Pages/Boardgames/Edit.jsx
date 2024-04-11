import React, {useState} from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
import {router} from "@inertiajs/react";
import DeleteGameButton from "../Components/DeleteGameButton.jsx";
function Edit({user, boardgame, gameUserInfo}) {

    const [data, setData] = useState({
        name: boardgame.name,
        imageurl: gameUserInfo.url,
        favourite: false
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
        router.patch(`/test/boardgames/${boardgame.id}/update`, data)
    }

    function checkdata(e) {
        console.log('data', data)
    }
    return (
        <>
            <AppLayout header="edit individual game" user={user}>
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
                        <label htmlFor="imageurl">Image URL:</label>
                        <input onChange={handleChange}
                               id="imageurl"
                               name="imageurl"
                               type="text"
                               value={data.imageurl}
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
                    <div>
                        <button type="submit">Update</button>
                        <a className="cancel-button" href="/dashboard">Cancel</a>
                    </div>
                </form>
                <DeleteGameButton boardgame={boardgame} />
                <button onClick={checkdata}>Check</button>
            </AppLayout>
        </>
    )
}

export default Edit;
