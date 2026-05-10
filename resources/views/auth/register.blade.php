<x-guest-layout>

    <div class="w-full max-w-xl mx-auto bg-[#fff44f] border-[5px] border-black p-8 shadow-[12px_12px_0px_#000] rotate-[-1deg]">

        <div class="mb-8">
            <h1 class="text-5xl font-black uppercase leading-none text-black">
                Create <br> Account
            </h1>

            <p class="mt-4 font-bold text-black text-sm uppercase tracking-wide">
                Join the platform & build your future.
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-black font-black uppercase mb-2">
                    Full Name
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    class="w-full border-[4px] border-black bg-white px-5 py-4 text-lg font-bold focus:outline-none focus:translate-x-1 focus:translate-y-1 transition-all"
                />

                <x-input-error :messages="$errors->get('name')" class="mt-2 font-bold text-red-700" />
            </div>

            <!-- Email -->
            <div>
                <label class="block text-black font-black uppercase mb-2">
                    Email Address
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    class="w-full border-[4px] border-black bg-cyan-200 px-5 py-4 text-lg font-bold focus:outline-none focus:translate-x-1 focus:translate-y-1 transition-all"
                />

                <x-input-error :messages="$errors->get('email')" class="mt-2 font-bold text-red-700" />
            </div>

            <!-- Password -->
            <div>
                <label class="block text-black font-black uppercase mb-2">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    class="w-full border-[4px] border-black bg-pink-200 px-5 py-4 text-lg font-bold focus:outline-none focus:translate-x-1 focus:translate-y-1 transition-all"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2 font-bold text-red-700" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-black font-black uppercase mb-2">
                    Confirm Password
                </label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    class="w-full border-[4px] border-black bg-green-200 px-5 py-4 text-lg font-bold focus:outline-none focus:translate-x-1 focus:translate-y-1 transition-all"
                />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 font-bold text-red-700" />
            </div>

            <div class="pt-4 space-y-4">

                <button
                    type="submit"
                    class="w-full bg-black text-white border-[4px] border-black py-4 text-lg font-black uppercase shadow-[6px_6px_0px_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all"
                >
                    Register →
                </button>

                <p class="text-center font-bold text-black">
                    Already registered?
                    <a
                        href="{{ route('login') }}"
                        class="underline decoration-[3px]"
                    >
                        Login Here
                    </a>
                </p>

            </div>
        </form>

    </div>

</x-guest-layout>