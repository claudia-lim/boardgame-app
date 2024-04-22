import React, {useEffect} from 'react';
import AppLayout from '../Layouts/AppLayout.jsx';
import { useState } from 'react';
import {router, usePage} from '@inertiajs/react';
import { useForm } from '@inertiajs/react';
function Create({user}) {
    const [data, setData] = useState({
        name: "",
        imageurl: "",
        favourite: false
    })
    const { errors } = usePage().props;
    const submitButton = document.querySelector('.submit-button');

    // const { data, setData, post, processing, errors } = useForm({
    //     input_gamename: '',
    //     imageurl: '',
    //     favourite: false,
    // })

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
    function handleSubmit(e) {
        e.preventDefault()
        router.post(route('boardgames.store'), data)
        submitButton.setAttribute('disabled', '');
        submitButton.classList.add('disabled-button');
    }
    return (
        <AppLayout header="Add New Game" user={user}>

            <div className="add-game-main">
                <form onSubmit={handleSubmit} className="add-game-form">
                    <div className="gamename-input-div">
                        <label htmlFor="name">Name: </label>
                        <input id="name" type="text" onChange={handleChange}/>
                    </div>
                    <p>{errors.name}</p>
                    <div className="image-url-input-div">
                        <label htmlFor="imageurl">Image URL:</label>
                        <input id="imageurl" type="text" onChange={handleChange}/>
                    </div>
                        <p>{errors.imageurl}</p>
                    <div className="favourite-input-div">
                        <label htmlFor="favourite">Favourite?</label>
                        <input id="favourite" type="checkbox" onChange={handleCheckbox}/>
                    </div>
                    <div className='buttons-div'>
                        <button type="submit" className='submit-button'>Add</button>
                        <a href={route('dashboard')}>
                            <button type='button'>
                                Cancel
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </AppLayout>
    )
}

    export default Create;
