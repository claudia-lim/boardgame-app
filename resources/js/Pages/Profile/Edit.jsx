import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import DeleteUserForm from './Partials/DeleteUserForm';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm';
import { Head } from '@inertiajs/react';
import AppLayout from "@/Pages/Layouts/AppLayout.jsx";

export default function Edit({ auth, mustVerifyEmail, status }) {
    console.log('edit profile page');
    return (
        <AppLayout user={auth.user} header="Edit Profile">
            <Head title="Profile" />

            <div >
                <div >
                    <div >
                        <UpdateProfileInformationForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                        />
                    </div>

                    <div >
                        <UpdatePasswordForm />
                    </div>

                    <div >
                        <DeleteUserForm/>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
