<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
            <script src="//unpkg.com/alpinejs" defer></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-white text-black">
    <div class="min-h-screen">

        <!-- NAV -->
        <nav class="brutal-sm bg-white px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-tight">
                CareerAI
            </h1>

            <div class="space-x-4">
                <a href="/dashboard" class="font-semibold hover:underline">Dashboard</a>
                <a href="/profile" class="font-semibold hover:underline">Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="brutal-btn px-4 py-1 text-sm bg-yellow-300">Logout</button>
                </form>
            </div>
        </nav>

        <!-- HEADER -->
        @if (isset($header))
            <header class="px-6 py-6">
                <div class="max-w-5xl mx-auto">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- CONTENT -->
        <main class="px-6 py-6">
            <div class="max-w-5xl mx-auto">
                {{ $slot }}
            </div>
        </main>

    </div>
</body>
</html>
