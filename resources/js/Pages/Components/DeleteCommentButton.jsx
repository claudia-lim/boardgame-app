import React from 'react';
import {router} from "@inertiajs/react";
function DeleteCommentButton({commentId}) {
    function handleSubmit(e) {
        e.preventDefault()
        router.delete(route('comments.delete', commentId),
            { preserveState:false })
    }
    return (
        <form onSubmit={handleSubmit}>
            <button className='comment-button delete' type="Submit">Delete Comment</button>
        </form>
    )
}

export default DeleteCommentButton;
