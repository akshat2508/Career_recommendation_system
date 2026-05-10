<section>
    <header class="mb-8">
        <h2 class="text-4xl font-black uppercase text-black">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-2 text-black font-bold text-sm">
            Secure your account with a strong password.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label class="block text-black font-black uppercase mb-2">
                Current Password
            </label>

            <input
                id="current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="w-full border-[4px] border-black bg-white px-5 py-4 text-lg font-bold"
            >

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 font-bold" />
        </div>

        <div>
            <label class="block text-black font-black uppercase mb-2">
                New Password
            </label>

            <input
                id="password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="w-full border-[4px] border-black bg-white px-5 py-4 text-lg font-bold"
            >

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 font-bold" />
        </div>

        <div>
            <label class="block text-black font-black uppercase mb-2">
                Confirm Password
            </label>

            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="w-full border-[4px] border-black bg-white px-5 py-4 text-lg font-bold"
            >

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 font-bold" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button
                type="submit"
                class="bg-black text-white border-[4px] border-black px-8 py-3 font-black uppercase shadow-[5px_5px_0px_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all"
            >
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="font-black text-green-900"
                >
                    Password Updated!
                </p>
            @endif
        </div>
    </form>
</section>