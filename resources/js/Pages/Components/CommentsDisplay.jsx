import React from 'react';
import DeleteCommentButton from "@/Pages/Components/DeleteCommentButton.jsx";
function CommentsDisplay({ comments, user}) {
    // console.log(comments);
    const commentsDisplay = comments.map((comment) => {
        const createdAt = new Date(comment['created_at']).toLocaleString('en-GB', { timeStyle: "short", dateStyle: "medium"})
        const editedAt = new Date(comment['updated_at']).toLocaleString('en-GB', { timeStyle: "short", dateStyle: "medium"});
        return (
            <section key={comment.id}>
            <h4>{comment.name}</h4>
            <p>{comment.comment}</p>
            <p>Created at: {createdAt}</p>
                {createdAt < editedAt ? <><p>Edited at: {editedAt}</p><p>Edited</p></> : ''}
            <p>{comment.public ? 'public' : 'private'}</p>
                {user.id === comment['user_id'] ? <a href={route('comments.edit', comment.id)}><button>Edit</button></a> : ''}
                {user.id === comment['user_id'] ? <DeleteCommentButton commentId={comment.id}/> : <div></div>}
            </section>
        )
    })
    return (
        <section className="comments">
            {commentsDisplay}
        </section>
    )
}

export default CommentsDisplay;
