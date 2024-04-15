import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faStar} from "@fortawesome/free-solid-svg-icons";
import {faStar as faRStar} from "@fortawesome/free-regular-svg-icons";
import React, {useState, useEffect} from "react";
import {Link, router} from "@inertiajs/react";
import axios from 'axios';

function FavouriteButton({favourite, boardgame}) {
    // let favourite = boardgame.pivot.favourite;
    const [favouriteDisplay, setFavouriteDisplay] = useState(favourite);
    // `updatefave/${boardgame.id}`
        const handleFave = () => {
            console.log('in handle fave func')
            console.log('favourite', favourite);
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
        console.log('use Effect triggered');
        console.log('favouriteDisplay currently: ', favouriteDisplay);
    }, [favouriteDisplay]);


    function handleClick() {
        setFavouriteDisplay(!favouriteDisplay);
        // handleFave();

        // fetch(route('boardgames.updatefave', boardgame.id), {
        //     headers: {"Content-Type":"application/json",
        //         "accept":"application/json"},
        //     method: 'PATCH',
        //     body: JSON.stringify( { favourite: favouriteState})
        // })
        //     .then((response)=> {
        //         console.log('in fetch')
        //         return response.json;
        //     })
        //     .then((data) => {
        //         console.log('data', data);
        //     })
        //     .catch((error) => {
        //         console.error('error', error);
        //     })
    }

if (favouriteDisplay) {
    return (
        <div onClick={handleClick}>
            {/*<Link as='button'*/}
            {/*      method='patch'*/}
            {/*      href={route('boardgames.updatefave', boardgame.id)}*/}
            {/*      data={favouriteState}>*/}
                <FontAwesomeIcon icon={faStar} className='favourite-icon solid'/>
            {/*</Link>*/}
        </div>
    )
} else {
    return (
        <div onClick={handleClick}>
            {/*<Link as='button'*/}
            {/*      method='patch'*/}
            {/*      href={route('boardgames.updatefave', boardgame.id)}*/}
            {/*      data={favouriteState}>*/}
                <FontAwesomeIcon icon={faRStar} className='favourite-icon regular'/>
            {/*</Link>*/}
        </div>
    )
}
}

export default FavouriteButton;
