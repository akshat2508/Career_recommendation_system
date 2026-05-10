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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
   <body class="font-sans bg-white text-black flex items-center justify-center min-h-screen">

    <div class="w-full  brutal p-8 bg-white">

        <!-- LOGO -->
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold">CareerAI</h1>
            <p class="text-sm mt-1">Find your path. Fast.</p>
        </div>

        {{ $slot }}

    </div>

</body>
</html>
