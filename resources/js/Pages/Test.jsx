import React from 'react';
import AppLayout from './Layouts/AppLayout.jsx'
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faStar} from "@fortawesome/free-solid-svg-icons";
import {faStar as faRStar} from "@fortawesome/free-regular-svg-icons";
import FavouriteButton from "@/Pages/Components/FavouriteButton.jsx";

const test = ({user}) => {
    return (
        <AppLayout header="Test Page header" user={user}>
        <h3>testing</h3>
            <h4>User = {user.name}</h4>
            <FavouriteButton />
        </AppLayout>
    )
}

export default test;
