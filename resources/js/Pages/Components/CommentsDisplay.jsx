import React from 'react';
function CommentsDisplay({ comments}) {
    // console.log(comments);
    const commentsDisplay = comments.map((comment) => {
        const createdAt = new Date(comment['created_at']).toLocaleString('en-GB', { timeStyle: "short", dateStyle: "medium"})
        return (
            <section key={comment.id}>
            <h4>{comment.name}</h4>
            <p>{comment.comment}</p>
            <p>{createdAt}</p>
                <p>{comment.public ? 'public' : 'private'}</p>
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
