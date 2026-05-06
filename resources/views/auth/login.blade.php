<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf

    <div>
        <label class="font-semibold">Email</label>
        <input type="email" name="email"
               class="w-full mt-2 p-2 brutal-sm focus:outline-none"
               required>
    </div>

    <div>
        <label class="font-semibold">Password</label>
        <input type="password" name="password"
               class="w-full mt-2 p-2 brutal-sm focus:outline-none"
               required>
    </div>

    <button class="w-full brutal-btn bg-blue-400 py-2 font-bold">
        LOGIN →
    </button>

    <p class="text-sm text-center">
        New here?
        <a href="{{ route('register') }}" class="underline font-semibold">
            Create account
        </a>
    </p>
</form>
</x-guest-layout>
