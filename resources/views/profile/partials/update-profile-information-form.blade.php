<section>
    <header class="mb-8">
        <h2 class="text-4xl font-black uppercase text-black">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-black font-bold text-sm">
            {{ __("Update your account details and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label class="block text-black font-black uppercase mb-2">
                Full Name
            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="w-full border-[4px] border-black bg-yellow-200 px-5 py-4 text-lg font-bold focus:outline-none focus:translate-x-1 focus:translate-y-1 transition-all"
            >

            <x-input-error class="mt-2 font-bold" :messages="$errors->get('name')" />
        </div>

        <div>
            <label class="block text-black font-black uppercase mb-2">
                Email Address
            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="w-full border-[4px] border-black bg-cyan-200 px-5 py-4 text-lg font-bold focus:outline-none focus:translate-x-1 focus:translate-y-1 transition-all"
            >

            <x-input-error class="mt-2 font-bold" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 bg-red-300 border-4 border-black p-4">
                    <p class="text-black font-bold">
                        {{ __('Your email address is unverified.') }}
                    </p>

                    <button
                        form="send-verification"
                        class="mt-3 bg-black text-white px-4 py-2 border-4 border-black font-black uppercase hover:bg-white hover:text-black transition"
                    >
                        {{ __('Resend Verification') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-3 text-green-900 font-black">
                            {{ __('Verification link sent successfully.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button
                type="submit"
                class="bg-black text-white border-[4px] border-black px-8 py-3 font-black uppercase shadow-[5px_5px_0px_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all"
            >
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="font-black text-green-800"
                >
                    Saved Successfully!
                </p>
            @endif
        </div>
    </form>
</section>