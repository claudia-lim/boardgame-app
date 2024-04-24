import React, {useState} from 'react';
import AppLayout from './Layouts/AppLayout.jsx'
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faStar} from "@fortawesome/free-solid-svg-icons";
import {faStar as faRStar} from "@fortawesome/free-regular-svg-icons";
import FavouriteButton from "@/Pages/Components/FavouriteButton.jsx";
import {router} from "@inertiajs/react";

const test = ({user, url}) => {
const [file, setFile] = useState(null);
function handleChange (e) {
     if (e.target.files) {
         setFile(e.target.files[0]);
     }
    }

function handleSubmit (e) {
    e.preventDefault();
    console.log('file', file);
    const formData = new FormData();
    formData.append("file", file);
    router.post(route('test.upload'), formData);
}

    return (
        <AppLayout header="Test Page header" user={user}>
            {/*{url ? <img src={`/storage/${url}`}></img> : ''}*/}
            <form className='add-game-form' onSubmit={handleSubmit}>
                <label htmlFor="fileupload">Select a file:</label>
                <input type="file" id="fileupload" name="fileupload" onChange={handleChange}/>
                <button type='submit'>Submit</button>
            </form>
            {file && (
                <section>
                    File details:
                    <ul>
                        <li>Name: {file.name}</li>
                        <li>Type: {file.type}</li>
                        <li>Size: {file.size} bytes</li>
                    </ul>
                </section>
            )}
        </AppLayout>
    )
}

export default test;
