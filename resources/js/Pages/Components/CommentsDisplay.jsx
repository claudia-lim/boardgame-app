import React, {useEffect, useState} from 'react';
import DeleteCommentButton from "@/Pages/Components/DeleteCommentButton.jsx";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faAngleLeft, faAngleRight, faSpinner} from "@fortawesome/free-solid-svg-icons";
function CommentsDisplay({ user, boardgame, commentType }) {
    // const initial = {data: [{boardgame_id: 0, comment: '', created_at: '', id: 0, name: '', public: 0, updated_at: '', user_id: 0}]}
    const [comments, setComments] = useState({});
    const [loading, setLoading] = useState(true);
    const [routeURL, setRouteURL] = useState(`/boardgames/${boardgame.id}/comments/${commentType}`);

    function getData()
    {
        axios.get(routeURL)
        .then(function (res) {
            console.log('response data', res.data);
            setComments(res.data);
            setLoading(false);
        })
        .catch(function (error) {
            console.error(error.message)
        })
    }

    useEffect (() => {
        setLoading(true);
        setRouteURL(`/boardgames/${boardgame.id}/comments/${commentType}`);
    }, [commentType])

    useEffect(() => {
        getData();
    }, [routeURL]);

    function nextButton () {
        setRouteURL(comments.next_page_url);
    }

    function prevButton () {
        setRouteURL(comments.prev_page_url);
    }

    let commentsDisplay = '';
    if (Object.keys(comments).length !== 0) {
        if (comments.data.length === 0) {
            commentsDisplay = <h4>No Comments Yet</h4>
        } else {
        commentsDisplay = comments.data.map((comment) => {
            const createdAt = new Date(comment['created_at']).toLocaleString('en-GB', { timeStyle: "short", dateStyle: "medium"})
            const editedAt = new Date(comment['updated_at']).toLocaleString('en-GB', { timeStyle: "short", dateStyle: "medium"});
            return (
                <div key={comment.id} className={`individual-comment ${comment.public ? 'public' : 'private'}`}>
                    <h4>{comment.name}</h4>
                    <p>{comment.comment}</p>
                    <p>Created at: {createdAt}</p>
                    {createdAt < editedAt ? <p>Edited at: {editedAt}</p> : ''}
                    {user.id === comment['user_id'] ? <a href={route('comments.edit', comment.id)}>
                                <button className='comment-button'>Edit Comment</button>
                            </a> : ''}
                    {user.id === comment['user_id'] ? <DeleteCommentButton commentId={comment.id}/> : <div></div>}
                </div>
            )
        })
        }
    }

    return (
        <>
            {loading ? <FontAwesomeIcon icon={faSpinner} spin className='spinner'/> : commentsDisplay}
            <div className='pagination-nav'>
                {comments.prev_page_url && !loading ? <button className='pagination-arrows' onClick={prevButton}>
                    <FontAwesomeIcon icon={faAngleLeft} />
                </button> : ''}
                {loading ? '' : <p className='pagination-arrows'>Page {comments.current_page} / {comments.last_page}</p>}
                {comments.next_page_url && !loading ? <button className='pagination-arrows' onClick={nextButton}>
                    <FontAwesomeIcon icon={faAngleRight} />
                </button> : ''}
            </div>
        </>
        )
}

export default CommentsDisplay;
