import React, {useEffect} from 'react';
import AppLayout from '../Layouts/AppLayout.jsx';
import { useState } from 'react';
import {router, usePage} from '@inertiajs/react';

function AddComment({user, boardgame}) {
    const [newComment, setNewComment] = useState({
        comment: '',
        public: true
    });
    const addCommentButton = document.querySelector('.add-comment-button');
    const { errors } = usePage().props;
    console.log('errors', errors);

    useEffect(() => {
        if (addCommentButton) {
                addCommentButton.removeAttribute('disabled');
                addCommentButton.classList.remove('disabled-button');
        }
    }, [errors]);

    function handleChange(e) {
        const key = e.target.id;
        const value = e.target.value
        setNewComment(newComment => ({
            ...newComment,
            [key]: value,
        }))
    }

    function handleCheckbox(e) {
        const key = e.target.id;
        const value = !e.target.checked;
        setNewComment(newComment=> ({
            ...newComment,
            [key]:value,
        }))
    }

    function handleSubmit(e) {
        e.preventDefault()
        router.post(route('comments.add', boardgame.id), newComment)
        addCommentButton.setAttribute('disabled', '');
        addCommentButton.classList.add('disabled-button');
    }

    return (
        <AppLayout header={`Add A Comment to ${boardgame.name}`} user={user}>
            <form onSubmit={handleSubmit} className='comment-form'>
                <label htmlFor='comment'>Comment: </label>
                <textarea onChange={handleChange}
                          id='comment'
                          type='text'
                          className='comment-input'></textarea>
                <p>{errors.comment}</p>
                <div>
                    <label htmlFor='public'>Make Post Private?</label>
                    <input onChange={handleCheckbox} id='public' type='checkbox' className='comment-public-checkbox'></input>
                </div>
                <div className='buttons-div'>
                    <button className='comment-button add-comment-button'>Add Comment</button>
                    <a href={route('boardgames.show', boardgame.id)}>
                        <button className='comment-button' type='button'>
                            Cancel
                        </button>
                    </a>
                </div>

            </form>
        </AppLayout>
    )
}

export default AddComment;
