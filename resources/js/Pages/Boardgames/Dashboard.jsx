import React from 'react';
import AppLayout from '../Layouts/AppLayout.jsx'
function Dashboard({user}) {
    return (
        <>

            <AppLayout header="Dashboard - React" user={user}>
                <div>Dashboard display</div>
            </AppLayout>
        </>
    )
}

export default Dashboard;
