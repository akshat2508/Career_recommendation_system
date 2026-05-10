<x-app-layout>
    <x-slot name="header">
        <div class="bg-yellow-300 border-4 border-black px-6 py-4 shadow-[8px_8px_0px_#000] rotate-[-1deg] inline-block">
            <h2 class="font-black text-3xl text-black uppercase tracking-wide">
                {{ __('My Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f4f1ea] min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <div class="bg-white border-[4px] border-black p-8 shadow-[10px_10px_0px_#000]">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-[#c4ff4d] border-[4px] border-black p-8 shadow-[10px_10px_0px_#000]">
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-[#ff8c42] border-[4px] border-black p-8 shadow-[10px_10px_0px_#000]">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>