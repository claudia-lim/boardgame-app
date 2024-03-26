{{--<x-app-layout>--}}
{{--@include('layouts.navigation')--}}
{{--    <x-slot name="header">--}}
<x-gameapplayout>


<x-slot name="header">
            {{ __('Dashboard') }}
</x-slot>
{{--    </x-slot>--}}

    <div class="">
        <div class="">
            <div class="">
                <div class="">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
{{--</x-app-layout>--}}
</x-gameapplayout>
