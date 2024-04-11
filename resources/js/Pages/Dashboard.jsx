import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import AppLayout from "@/Pages/Layouts/AppLayout.jsx";

export default function Dashboard({ auth }) {
    console.log('in new react component dashboard')
    return (
        <AppLayout
            user={auth.user} header="React Dashboard">
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">You're logged in!</div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
