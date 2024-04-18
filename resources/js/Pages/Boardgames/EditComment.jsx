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
        <AppLayout header='edit comment' user={user}>
            <form onSubmit={handleSubmit}>
                <label htmlFor='comment'>Comment</label>
                <input onChange={handleChange} id='comment' type='text' value={updatedComment.comment}></input>
                <label htmlFor='public'>Make Post Private?</label>
                <input onChange={handleCheckbox} id='public' type='checkbox' checked={!updatedComment.public}></input>
                <div className='buttons-div'>
                    <button>Add Comment</button>
                    <a href={route('boardgames.show', currentComment.currentComment.boardgame_id)}>
                        <button type='button'>
                            Cancel
                        </button>
                    </a>
                </div>

            </form>
        </AppLayout>

    )
}

export default EditComment;
