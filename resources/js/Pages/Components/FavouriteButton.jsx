import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faStar} from "@fortawesome/free-solid-svg-icons";
import {faStar as faRStar} from "@fortawesome/free-regular-svg-icons";
import React, {useState, useEffect} from "react";
import axios from 'axios';

function FavouriteButton({favourite, boardgame}) {
    const [favouriteDisplay, setFavouriteDisplay] = useState(favourite);
    const [animate, setAnimate] = useState('');
    const [errorMessage, setErrorMessage] = useState('')
    const handleFave = () => {
        axios.patch(route('boardgames.updatefave', boardgame.id), {favourite: favouriteDisplay} )
            .then(res => {
                // console.log(res);
                setAnimate('');
            })
            .catch(err => {
                console.error(err);
                setErrorMessage('An error has occurred');
            })
    }

    useEffect(() => {
        handleFave();
    }, [favouriteDisplay]);


    function handleClick() {
        setFavouriteDisplay(!favouriteDisplay);
        setAnimate('fa-spin')
    }



if (favouriteDisplay) {
    return (
        <>
            <div onClick={handleClick}>
                    <FontAwesomeIcon icon={faStar} className={`favourite-icon solid ${animate}`}/>
            </div>
            {errorMessage && <p>{errorMessage}</p>}
        </>
        )
    } else {
        return (
            <>
                <div onClick={handleClick}>
                    <FontAwesomeIcon icon={faRStar} className={`favourite-icon regular ${animate}`}/>
                </div>
                {errorMessage && <p>{errorMessage}</p>}
            </>
        )
}
}

export default FavouriteButton;
