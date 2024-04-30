import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, Link} from '@inertiajs/react';
import AppLayout from "@/Pages/Layouts/AppLayout.jsx";
import FavouriteButton from "@/Pages/Components/FavouriteButton.jsx";
import DeleteGameButton from "@/Pages/Components/DeleteGameButton.jsx";
import DeleteCommentButton from "@/Pages/Components/DeleteCommentButton.jsx";

function Dashboard({ auth, latestGame, latestComment }) {

    let latestGameDisplay = <h1 className="dashboard-latest-game">No games added yet</h1>
    if (latestGame.length !== 0) {
        const dateGameAdded = new Date(latestGame[0].pivot.created_at).toLocaleString('en-GB', {
            timeStyle: "short",
            dateStyle: "medium"
        })
        latestGameDisplay = (
            <div className="dashboard-latest-game">
                <h1>Most Recent Game Added to Your Collection:</h1>
                <h2 className='game-name'>{latestGame[0].pivot.custom_name ? latestGame[0].pivot.custom_name : latestGame[0].name}</h2>
                <div className="dashboard-game-section-images">
                    <img className="dashboard-game-image" alt="boardgame image"
                         src={latestGame[0].pivot.imageUrl ? latestGame[0].pivot.imageUrl : `/storage/${auth.defaultImage}`}/>
                    <div className="fave-icon">
                        <FavouriteButton boardgame={latestGame[0]} favourite={latestGame[0].pivot.favourite}/>
                    </div>
                </div>
                <p>Added to collection on: {dateGameAdded}</p>
                <div className="dashboard-game-section-buttons">
                    <Link as='button' href={route('boardgames.show', latestGame[0].id)}>Show</Link>
                    <Link as="button" href={route('boardgames.edit', latestGame[0].id)}>Edit</Link>
                    <DeleteGameButton boardgame={latestGame[0]}/>
                </div>
            </div>)
    }

    let latestCommentDisplay = <h1 className='dashboard-latest-comment'>No comments made yet</h1>
    if (latestComment.length !== 0) {
        const createdAt = new Date(latestComment[0]['created_at']).toLocaleString('en-GB', {
            timeStyle: "short",
            dateStyle: "medium"
        })
        const editedAt = new Date(latestComment[0]['updated_at']).toLocaleString('en-GB', {
            timeStyle: "short",
            dateStyle: "medium"
        });
        latestCommentDisplay = (
            <div className='dashboard-latest-comment'>
                <h1>Your Most Recent Comment:</h1>
                <h2 className='game-name'>{latestComment[0].custom_name ? latestComment[0].custom_name : latestComment[0].name}</h2>
                <h4 className='dashboard-comment'>{latestComment[0].comment}</h4>
                <p>Posted at: {createdAt}</p>
                {createdAt < editedAt ? <p>Edited at: {editedAt}</p> : ''}
                <p>{latestComment[0].public ? 'Public' : 'Private'} post</p>
                {auth.user.id === latestComment[0]['user_id'] ?
                    <a href={route('comments.edit', latestComment[0].id)}>
                        <button className='comment-button'>Edit Comment</button>
                    </a> : ''}
                {auth.user.id === latestComment[0]['user_id'] ?
                    <DeleteCommentButton commentId={latestComment[0].id}/> : <div></div>}
            </div>
        )
    }

    return (
        <AppLayout user={auth.user} header="Dashboard">
            <Head title="Dashboard"/>
            <div className='dashboard-display'>
                <div>
                    {latestGameDisplay}
                </div>
                <div>
                    {latestCommentDisplay}
                </div>
            </div>
        </AppLayout>
    );

}

export default Dashboard;
