import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx';
import { useState } from 'react';
import { router } from '@inertiajs/react';

function AddComment({user, boardgame}) {
    const [newComment, setNewComment] = useState({
        comment: '',
        public: true
    });

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
        // console.log(newComment);
        router.post(route('comments.add', boardgame.id), newComment)
    }

    return (
        <AppLayout header="Add A Comment - React" user={user}>
            <h2>Comment on {boardgame.name}</h2>
            <form onSubmit={handleSubmit}>
                <label htmlFor='comment'>Comment</label>
                <input onChange={handleChange} id='comment' type='text'></input>
                <label htmlFor='public'>Make Post Private?</label>
                <input onChange={handleCheckbox} id='public' type='checkbox'></input>
                <button>Add Comment</button>
            </form>
                <a className="cancel-button" href={route('dashboard')}>Cancel</a>
        </AppLayout>
    )
}

export default AddComment;
