<x-app-layout>
<div class="p-6 max-w-7xl mx-auto">

    <!-- 🔥 Latest Recommendation -->
    @if($latest)

    <!-- Tags -->
    <div class="mt-6 flex gap-3 flex-wrap">
        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">AI Generated</span>
        <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">Career Path</span>
    </div>

    <!-- Main Card -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-8 rounded-2xl shadow-lg mt-4">

        <!-- Title -->
        <h1 class="text-3xl font-bold mb-2">
            {{ $latest->career_name }}
        </h1>

        <!-- Description -->
        <p class="text-lg opacity-90 mt-2">
            {{ $latest->description }}
        </p>
       @php
    $required = array_map(fn($s) => strtolower(trim($s)), $latest->required_skills ?? []);
    $userSkillsLower = array_map(fn($s) => strtolower(trim($s)), $userSkills ?? []);

    $matched = array_intersect($required, $userSkillsLower);

    $matchScore = count($required) > 0 ? round((count($matched)/count($required))*100) : 0;
@endphp

<!-- 🎯 Match Score -->
<div class="mt-4">
    <div class="flex justify-between text-sm mb-1">
        <span>Match</span>
        <span>{{ $matchScore }}%</span>
    </div>
    <div class="w-full bg-white/20 h-2 rounded-full">
        <div class="bg-white h-2 rounded-full" style="width: {{ $matchScore }}%"></div>
    </div>
</div>

        <!-- Skills -->
        @if(!empty($latest->required_skills))
        <div class="mt-6">
            <h3 class="font-semibold mb-2">Required Skills</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($latest->required_skills as $skill)
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm">
                        {{ $skill }}
                    </span>
                @endforeach
            </div>
        </div>
        @endif
        <!-- ❌ Missing Skills -->
<div class="mt-4">
    <h4 class="text-sm font-semibold mb-1">Skill Gap</h4>
    <div class="flex flex-wrap gap-2">
        @foreach($latest->required_skills as $skill)
            @if(!in_array(strtolower(trim($skill)), $userSkillsLower))
                <span class="bg-red-400/30 px-2 py-1 rounded text-xs">
                    {{ $skill }}
                </span>
            @endif
        @endforeach
    </div>
</div>

        <!-- Roadmap -->
        @if(!empty($latest->roadmap))
        <div class="mt-6">
            <h3 class="font-semibold mb-2">Roadmap</h3>
            <ul class="space-y-2">
                @foreach($latest->roadmap as $step)
                    <li class="flex items-start gap-2">
                        <span class="bg-white/30 px-2 rounded">→</span>
                        <span>{{ $step }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Timestamp -->
        <p class="text-sm mt-6 opacity-75">
            Generated on {{ $latest->created_at->format('d M Y, h:i A') }}
        </p>

    </div>

    @else
<div class="text-center mt-10">

    <h2 class="text-2xl font-semibold mb-4">
        No recommendations yet
    </h2>

    <p class="text-gray-600 mb-6">
        Build your profile to get AI-powered career suggestions 🚀
    </p>

    <a href="{{ route('career.create') }}"
       class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
        Generate Career Path
    </a>

</div>    @endif


    <!-- 📜 History -->
   <!-- 📜 History -->
<h2 class="text-2xl font-semibold mt-10 mb-4">History</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach($history as $item)
    <a href="{{ route('career.show', $item->id) }}">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition cursor-pointer">

            <!-- Title -->
            <h3 class="text-xl font-bold">
                {{ $item->career_name }}
            </h3>

            <!-- Description -->
            <p class="text-gray-600 mt-2 text-sm">
                {{ $item->description }}
            </p>

            <!-- Skills -->
            @if(!empty($item->required_skills))
            <div class="mt-3 flex flex-wrap gap-2">
                @foreach($item->required_skills as $skill)
                    <span class="bg-gray-200 px-2 py-1 rounded text-xs">
                        {{ $skill }}
                    </span>
                @endforeach
            </div>
            @endif

            <!-- Date -->
            <p class="text-xs text-gray-400 mt-4">
                {{ $item->created_at->format('d M Y') }}
            </p>

        </div>
    </a>
    @endforeach

</div>
</x-app-layout>