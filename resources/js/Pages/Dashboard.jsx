import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import AppLayout from "@/Pages/Layouts/AppLayout.jsx";

export default function Dashboard({ auth }) {
    console.log('in new react component dashboard')
    return (
        <AppLayout
            user={auth.user} header="Dashboard">
            <Head title="Dashboard" />
            <div>You're logged in!</div>
        </AppLayout>
    );
}
