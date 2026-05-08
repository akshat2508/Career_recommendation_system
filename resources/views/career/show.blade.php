<x-app-layout>

<div class="max-w-5xl mx-auto space-y-8">

    <!-- 🔙 BACK -->
    <a href="/dashboard" class="font-semibold hover:underline">
        ← Back To Dashboard
    </a>

    <!-- 🔥 HERO -->
    <div class="brutal p-8 bg-yellow-200">

        <p class="text-sm font-semibold mb-2">CAREER RESULT</p>

        <h1 class="text-3xl font-bold">
            {{ $career->career_name }}
        </h1>

        <p class="mt-3 max-w-2xl">
            {{ $career->description }}
        </p>

    </div>


    <!-- 🧠 WHY FIT -->
    <div class="brutal p-6 bg-white">

        <h3 class="text-lg font-bold mb-3">Why This Fits You</h3>

        <p class="text-sm">
            {{ $career->why_fit }}
        </p>

    </div>


    <!-- 🎯 MATCH SCORE -->
    <div class="brutal p-6 bg-white">

        <h3 class="text-lg font-bold mb-4">Match Score</h3>

        <div class="flex justify-between text-sm mb-2">
            <span>Your Fit</span>
            <span class="font-bold">{{ $matchScore }}%</span>
        </div>

        <div class="w-full h-3 bg-gray-200">
            <div class="h-3 bg-black"
                 style="width: {{ $matchScore }}%"></div>
        </div>

        <p class="text-sm mt-2">
            @if($matchScore >= 70)
                Strong alignment 🚀
            @elseif($matchScore >= 40)
                Moderate alignment
            @else
                Needs improvement
            @endif
        </p>

    </div>


    <!-- 🧩 SKILLS + GAP -->
    <div class="grid md:grid-cols-2 gap-6">

        <!-- REQUIRED -->
        <div class="brutal p-6 bg-white">

            <h3 class="font-bold mb-3">Required Skills</h3>

            <div class="flex flex-wrap gap-2">
                @foreach($career->required_skills as $skill)
                    <span class="brutal-sm px-2 py-1 text-sm">
                        {{ ucfirst($skill) }}
                    </span>
                @endforeach
            </div>

        </div>

        <!-- GAP -->
        <div class="brutal p-6 bg-white">

            <h3 class="font-bold mb-3">Skill Gap</h3>

            @php
                $missing = array_filter($career->required_skills, function($skill) use ($userSkills) {
                    return !in_array(strtolower(trim($skill)), $userSkills);
                });
            @endphp

            @if(count($missing))
                <div class="flex flex-wrap gap-2">
                    @foreach($missing as $skill)
                        <span class="brutal-sm px-2 py-1 text-sm bg-red-200">
                            {{ ucfirst($skill) }}
                        </span>
                    @endforeach
                </div>
            @else
                <p class="text-sm">You already meet all requirements 🎯</p>
            @endif

        </div>

    </div>


    <!-- 🛣️ ROADMAP -->
    <div class="brutal p-6 bg-white">

        <h3 class="font-bold mb-4">Roadmap</h3>

        <ul class="space-y-3">
            @foreach($career->roadmap as $step)
                <li class="flex items-start gap-3">
                    <span class="brutal-sm px-2">→</span>
                    <span>{{ $step }}</span>
                </li>
            @endforeach
        </ul>

    </div>


    <!-- 📅 META -->
    <div class="text-sm text-gray-500">
        Generated on {{ $career->created_at->format('d M Y, h:i A') }}
    </div>


    <!-- ⚡ ACTIONS -->
    <div class="flex gap-4">

        <a href="{{ route('career.pdf', $career->id) }}"
           class="brutal-btn bg-green-300 px-4 py-2 font-bold">
            Download Report
        </a>

        @php
            $hasPersonality = auth()->user()->profile && auth()->user()->profile->personality;
        @endphp

        <a href="{{ $hasPersonality ? route('career.create') : route('personality') }}"
           class="brutal-btn bg-blue-300 px-4 py-2 font-bold">
            New Analysis
        </a>

    </div>

</div>

</x-app-layout>