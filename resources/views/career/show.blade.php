<x-app-layout>
<div class="max-w-4xl mx-auto p-6">

    <!-- Back -->
    <a href="/dashboard" class="text-blue-600 hover:underline mb-4 inline-block">
        ← Back to Dashboard
    </a>

    <!-- Card -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-8 rounded-2xl shadow-lg">

        <!-- Title -->
        <h1 class="text-3xl font-bold mb-2">
            {{ $career->career_name }}
        </h1>

        <!-- Description -->
        <p class="text-lg opacity-90 mt-2">
            {{ $career->description }}
        </p>

        <!-- Skills -->
        <div class="mt-6">
            <h3 class="font-semibold mb-2">Required Skills</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($career->required_skills as $skill)
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm">
                        {{ $skill }}
                    </span>
                @endforeach
            </div>
        </div>

        <!-- Roadmap -->
        <div class="mt-6">
            <h3 class="font-semibold mb-2">Roadmap</h3>
            <ul class="space-y-3">
                @foreach($career->roadmap as $step)
                    <li class="flex items-start gap-3">
                        <span class="bg-white/30 px-2 py-1 rounded">→</span>
                        <span>{{ $step }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Date -->
        <p class="text-sm mt-6 opacity-75">
            Generated on {{ $career->created_at->format('d M Y, h:i A') }}
        </p>

    </div>

</div>
</x-app-layout>