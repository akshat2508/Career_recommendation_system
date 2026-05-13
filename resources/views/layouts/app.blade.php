<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--favicon  -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
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

            <!-- LOGO -->
            <a href="/dashboard" class="text-xl font-bold tracking-tight">
                CareerAI
            </a>

            @php
            $hasPersonality = auth()->user()->profile && auth()->user()->profile->personality;
            @endphp

            <!-- NAV LINKS -->
            <div class="flex items-center gap-6">

                <a href="/dashboard" class="font-semibold hover:underline">
                    Dashboard
                </a>
                <a href="{{ route('resume.form') }}"
                    class="font-semibold hover:underline">
                    Resume AI
                </a>

                <!-- 🔥 MAIN FEATURE -->
                <a href="{{ $hasPersonality ? route('career.create') : route('personality') }}"
                    class="brutal-btn px-4 py-1 bg-blue-300 font-semibold">
                    Analyze
                </a>

                <a href="{{ route('profile.edit') }}" class="font-semibold hover:underline">
                    Profile
                </a>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="brutal-btn px-4 py-1 text-sm bg-yellow-300">
                        Logout
                    </button>
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