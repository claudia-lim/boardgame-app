import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faStar} from "@fortawesome/free-solid-svg-icons";
import {faStar as faRStar} from "@fortawesome/free-regular-svg-icons";
import React, {useState, useEffect} from "react";
import {Link, router} from "@inertiajs/react";
import axios from 'axios';

function FavouriteButton({favourite, boardgame}) {
    const [favouriteDisplay, setFavouriteDisplay] = useState(favourite);
        const handleFave = () => {
            axios.patch(route('boardgames.updatefave', boardgame.id), {favourite: favouriteDisplay} )
                .then(res => {
                    console.log(res.data);
                })
                .catch(err => {
                    console.log(err);
                })
        }

    useEffect(() => {
        handleFave();
    }, [favouriteDisplay]);


    function handleClick() {
        setFavouriteDisplay(!favouriteDisplay);
    }

if (favouriteDisplay) {
    return (
        <div onClick={handleClick}>
                <FontAwesomeIcon icon={faStar} className='favourite-icon solid'/>
        </div>
    )
} else {
    return (
        <div onClick={handleClick}>
                <FontAwesomeIcon icon={faRStar} className='favourite-icon regular'/>
        </div>
    )
}
}

export default FavouriteButton;
