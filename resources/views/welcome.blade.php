<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CareerAI</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-white text-black font-sans">

<div class="min-h-screen flex flex-col justify-center items-center text-center px-6">

    <!-- HERO -->
    <div class="brutal p-10 max-w-xl">

        <h1 class="text-4xl font-bold mb-4">
            CareerAI
        </h1>

        <p class="text-lg mb-6">
            Discover the best career path based on your skills, interests, and personality.
        </p>

        <div class="flex gap-4 justify-center">

            <a href="{{ route('login') }}"
               class="brutal-btn px-6 py-3 bg-blue-300 font-bold">
                Login →
            </a>

            <a href="{{ route('register') }}"
               class="brutal-btn px-6 py-3 bg-yellow-300 font-bold">
                Get Started →
            </a>

        </div>

    </div>

</div>

</body>
</html>