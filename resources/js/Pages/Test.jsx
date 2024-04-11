import React from 'react';
import AppLayout from './Layouts/AppLayout.jsx'
const test = ({user}) => {
    console.log('in test.jsx');
    return (
        <AppLayout header="Test Page header" user={user}>
        <h3>testing</h3>
            <h4>User = {user.name}</h4>
        </AppLayout>
    )
}

export default test;
