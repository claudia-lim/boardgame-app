import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
function Create({user}) {
    return (
        <>
            <AppLayout header="Add New Game - React" user={user}>
                <div>Add board game form here</div>
            </AppLayout>
        </>
    )
}

export default Create;
