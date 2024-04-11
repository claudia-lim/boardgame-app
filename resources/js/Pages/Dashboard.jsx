import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import AppLayout from "@/Pages/Layouts/AppLayout.jsx";

export default function Dashboard({ auth }) {
    console.log('in new react component dashboard')
    return (
        <AppLayout
            user={auth.user} header="React Dashboard">
            <Head title="Dashboard" />

            <div>
                <div>
                    <div>
                        <div>You're logged in!</div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
