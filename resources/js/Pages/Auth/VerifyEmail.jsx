import GuestLayout from '@/Layouts/GuestLayout';
import PrimaryButton from '@/Components/PrimaryButton';
import { Head, Link, useForm } from '@inertiajs/react';
import Guest from "@/Layouts/GuestLayout";

export default function VerifyEmail({ status }) {
    const { post, processing } = useForm({});

    const submit = (e) => {
        e.preventDefault();

        post(route('verification.send'));
    };

    return (
        <Guest header="Verify Email">
            <Head title="Email Verification" />

            <div>
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the
                link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </div>

            {status === 'verification-link-sent' && (
                <div>
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            )}

            <form onSubmit={submit}>
                <div>
                    <PrimaryButton disabled={processing}>Resend Verification Email</PrimaryButton>

                    <Link
                        href={route('logout')}
                        method="post"
                        as="button"
                        className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Log Out
                    </Link>
                </div>
            </form>
        </Guest>
    );
}
