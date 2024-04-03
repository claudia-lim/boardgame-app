<x-gameapplayout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="profile-page">
                <div>
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div>
                    @include('profile.partials.update-password-form')
                </div>
                <div>
                    @include('profile.partials.delete-user-form')
                </div>
    </div>
</x-gameapplayout>
