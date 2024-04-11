import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx';
import { useState } from 'react';
import { router } from '@inertiajs/react';
import { useForm } from '@inertiajs/react';
function Create({user}) {
    const [data, setData] = useState({
        name: "",
        imageurl: "",
        favourite: false
    })

    // const { data, setData, post, processing, errors } = useForm({
    //     input_gamename: '',
    //     imageurl: '',
    //     favourite: false,
    // })

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
        router.post('/test/boardgames/store', data)
    }
    return (
        <>
            <AppLayout header="Add New Game - React" user={user}>

                <div className="add-game-main">

                    <form onSubmit={handleSubmit} className="add-game-form">

                        <div className="gamename-input-div">
                            <label htmlFor="name">Name: </label>
                            <input id="name" type="text" onChange={handleChange}/>
                        </div>
                        <div className="image-url-input-div">
                            <label htmlFor="imageurl">Image URL:</label>
                            <input id="imageurl" type="text" onChange={handleChange}/>
                        </div>
                        <div className="favourite-input-div">
                            <label htmlFor="favourite">Favourite?</label>
                            <input id="favourite" type="checkbox" onChange={handleCheckbox}/>
                        </div>

                        <div>
                            <button type="submit">Add</button>
                            <a className="cancel-button" href="/test/dashboard">Cancel</a>
                        </div>
                    </form>

                </div>

            </AppLayout>
        </>
    )
}

    export default Create;
