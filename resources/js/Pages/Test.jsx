import React from 'react';
import AppLayout from './Layouts/AppLayout.jsx'
const test = () => {
    console.log('in test.jsx');
    return (
        <AppLayout header="Test Page header">
        <h3>testing</h3>
        </AppLayout>
    )
}

export default test;
