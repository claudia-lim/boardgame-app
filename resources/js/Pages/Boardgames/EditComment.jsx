import React, {useState} from 'react';
import AppLayout from "@/Pages/Layouts/AppLayout.jsx";
import {router} from "@inertiajs/react";

function EditComment (currentComment, user) {
    console.log('currentcomment', currentComment);


    const [updatedComment, setUpdatedComment] = useState({
        comment: currentComment.currentComment.comment,
        public: currentComment.currentComment.public
    });

    function handleChange(e) {
        const key = e.target.id;
        const value = e.target.value
        setUpdatedComment(editComment => ({
            ...editComment,
            [key]: value,
        }))
    }

    function handleCheckbox(e) {
        const key = e.target.id;
        const value = !e.target.checked;
        setUpdatedComment(updatedComment => ({
            ...updatedComment,
            [key]:value,
        }))
    }

    function handleSubmit(e) {
        e.preventDefault()
        // console.log(updatedComment);
        router.patch(route('comments.update', currentComment.currentComment.id), updatedComment)
    }


    return (
        <AppLayout header='Edit Comment' user={user}>
            <form onSubmit={handleSubmit} className='comment-form'>
                <label htmlFor='comment'>Comment: </label>
                <textarea onChange={handleChange} id='comment' type='text' value={updatedComment.comment} className='comment-input'></textarea>
                <div>
                    <label htmlFor='public'>Make Post Private?</label>
                    <input onChange={handleCheckbox} id='public' type='checkbox' checked={!updatedComment.public} className='comment-public-checkbox'></input>
                </div>
                <div className='buttons-div'>
                    <button className='comment-button'>Update Comment</button>
                    <a href={route('boardgames.show', currentComment.currentComment.boardgame_id)}>
                        <button type='button' className='comment-button'>
                            Cancel
                        </button>
                    </a>
                </div>

            </form>
        </AppLayout>

    )
}

export default EditComment;
