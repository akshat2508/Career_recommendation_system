<x-guest-layout>

    <div class="w-full max-w-2xl mx-auto bg-yellow-300 border-[5px] border-black p-8 shadow-[10px_10px_0px_#000]">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="font-black uppercase">Email</label>

                <input
                    type="email"
                    name="email"
                    class="w-full mt-2 p-4 border-[4px] border-black bg-white font-bold focus:outline-none"
                    required
                >
            </div>

            <div>
                <label class="font-black uppercase">Password</label>

                <input
                    type="password"
                    name="password"
                    class="w-full mt-2 p-4 border-[4px] border-black bg-pink-200 font-bold focus:outline-none"
                    required
                >
            </div>

            <button class="w-full bg-black text-white border-[4px] border-black py-4 font-black text-lg uppercase shadow-[5px_5px_0px_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                LOGIN →
            </button>

            <p class="text-sm text-center font-bold">
                New here?

                <a href="{{ route('register') }}" class="underline">
                    Create account →
                </a>
            </p>

        </form>

    </div>

</x-guest-layout>