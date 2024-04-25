import React, {useEffect, useState} from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
import {router, usePage} from "@inertiajs/react";
import DeleteGameButton from "../Components/DeleteGameButton.jsx";
function Edit({user, boardgame, gameUserInfo, auth}) {

    const startingName = gameUserInfo['custom_name'] ? gameUserInfo['custom_name'] : boardgame.name;
    const { errors } = usePage().props;
    const [data, setData] = useState({
        name: startingName,
        imageUrl: gameUserInfo.imageUrl,
        favourite: gameUserInfo.favourite
    })
    const submitButton = document.querySelector('.submit-button');
    const imageUpload = document.querySelector('#imageUrl');
    const imageUploadDiv = document.querySelector('.upload-image-div');

    useEffect(() => {
        if (submitButton) {
            submitButton.removeAttribute('disabled');
            submitButton.classList.remove('disabled-button');
        }
    }, [errors]);

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

    function handleFileUpload (e) {
    console.log(e.target.files);
    const file = e.target.files[0];
    setData(data=> ({
        ...data,
        imageUrl:file,
    }))
    }

    function handleRemoveImage(e) {
        if (e.target.checked) {
            setData(data=> ({
                ...data,
                imageUrl: '',
            }))
            imageUpload.value = '';
            imageUploadDiv.classList.add('hidden');
        } else {
            imageUploadDiv.classList.remove('hidden');
        }
    }
    function handleSubmit(e) {
        e.preventDefault()
        router.post(route('boardgames.update', boardgame.id), data)
        submitButton.setAttribute('disabled', '');
        submitButton.classList.add('disabled-button');
    }


    return (
        <>
            <AppLayout header={`Edit: ${startingName}`} user={user}>
                <form onSubmit={handleSubmit} className="edit-game-form">

                    <div className="gamename-input-div">
                        <label htmlFor="input-gamename">Name: </label>
                        <input onChange={handleChange}
                               id="name"
                               type="text"
                               value={data.name}/>
                    </div>

                    {errors.name ? <p>{errors.name}</p> : ''}

                    <div>

                            {gameUserInfo.custom_name ? <p>Note this is your custom name, official name is: <span
                                className='game-name'>{boardgame.name}</span></p> : ''}

                    </div>

                    <div className='edit-current-image-div'>
                        <h4>Current image:</h4>
                        <img className="edit-game-current-image" alt='image for current board game'
                             src={gameUserInfo.imageUrl ? gameUserInfo.imageUrl : `/storage/${auth.defaultImage}`}></img>
                    </div>

                    <div>
                        <label htmlFor='removeImage'>Remove Image (default image will be used instead)</label>
                        <input type='checkbox' id='removeImage' name='removeImage' onChange={handleRemoveImage}></input>
                    </div>

                    <div className="upload-image-div">
                        <label htmlFor="imageUrl">Upload an image:</label>
                        <input type="file" id="imageUrl" name="imageUrl" onChange={handleFileUpload}/>
                    </div>

                    {errors.imageUrl ? <p>{errors.imageUrl}</p> : ''}
                    <div className="favourite-input-div">
                        <label htmlFor="favourite">Favourite?</label>
                        <input id="favourite"
                               onChange={handleCheckbox}
                               name="favourite"
                               checked={data.favourite}
                               type="checkbox"/>
                    </div>
                    <div className='buttons-div'>
                        <button type="submit" className='submit-button'>Update</button>
                    </div>
                <a href={route('boardgames.show', boardgame.id)}>
                    <button type='button'>
                        Cancel
                    </button>
                </a>
                <DeleteGameButton boardgame={boardgame}/>
                </form>

                {/*<button onClick={checkdata}>Check</button>*/}
            </AppLayout>
        </>
    )
}

export default Edit;
