<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <!-- 🔥 HERO (BEST MATCH) -->
    @if($best)
    <div class="brutal p-8 bg-yellow-200 mb-10">
        <p class="text-sm font-semibold mb-2">TOP MATCH</p>

        <h1 class="text-3xl font-bold">
            {{ $best->career_name }}
        </h1>

        <p class="mt-3 max-w-xl">
            {{ $best->description }}
        </p>

        <div class="mt-4 text-lg font-bold">
            {{ $best->matchScore }}% MATCH
        </div>
    </div>
    @endif


    <!-- 🚀 LATEST RECOMMENDATION -->
    @if($latest && (!$best || $latest->id !== $best->id))

    <a href="{{ route('career.show', $latest->id) }}">
    <div class="brutal p-8 bg-white cursor-pointer mb-10">

        <p class="text-sm font-semibold mb-2">LATEST ANALYSIS</p>

        <h2 class="text-2xl font-bold">
            {{ $latest->career_name }}
        </h2>

        <p class="mt-2">
            {{ $latest->description }}
        </p>

        <!-- MATCH CALC -->
        @php
            $required = array_map(fn($s) => strtolower(trim($s)), $latest->required_skills ?? []);
            $userSkillsLower = array_map(fn($s) => strtolower(trim($s)), $userSkills ?? []);
            $matched = array_intersect($required, $userSkillsLower);
            $matchScore = count($required) > 0 ? round((count($matched)/count($required))*100) : 0;
        @endphp

        <!-- MATCH BAR -->
        <div class="mt-6">
            <div class="flex justify-between text-sm">
                <span>Match Score</span>
                <span class="font-bold">{{ $matchScore }}%</span>
            </div>
            <div class="w-full h-3 bg-gray-200 mt-2">
                <div class="h-3 bg-black" style="width: {{ $matchScore }}%"></div>
            </div>
        </div>

        <!-- WHY FIT -->
        @if(!empty($latest->why_fit))
        <div class="mt-6 brutal-sm p-4 bg-gray-50">
            <p class="text-sm font-semibold mb-1">WHY THIS FITS YOU</p>
            <p class="text-sm">
                {{ \Illuminate\Support\Str::limit($latest->why_fit, 120) }}
            </p>
        </div>
        @endif

        <!-- REQUIRED SKILLS -->
        @if(!empty($latest->required_skills))
        <div class="mt-6">
            <p class="font-semibold mb-2">Required Skills</p>
            <div class="flex flex-wrap gap-2">
                @foreach($latest->required_skills as $skill)
                    <span class="brutal-sm px-2 py-1 text-sm bg-white">
                        {{ ucfirst($skill) }}
                    </span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- SKILL GAP -->
        @php
            $missing = array_filter($latest->required_skills, function($skill) use ($userSkills) {
                return !in_array(strtolower(trim($skill)), $userSkills);
            });
        @endphp

        <div class="mt-6">
            <p class="font-semibold mb-2">Skill Gap</p>

            @if(count($missing) > 0)
                <div class="flex flex-wrap gap-2">
                    @foreach($missing as $skill)
                        <span class="brutal-sm px-2 py-1 text-sm bg-red-200">
                            {{ ucfirst($skill) }}
                        </span>
                    @endforeach
                </div>
            @else
                <p class="text-sm">You’re fully aligned 🎯</p>
            @endif
        </div>

        <!-- ROADMAP -->
        @if(!empty($latest->roadmap))
        <div class="mt-6">
            <p class="font-semibold mb-2">Roadmap</p>
            <ul class="space-y-2">
                @foreach($latest->roadmap as $step)
                    <li class="flex items-start gap-2">
                        <span class="brutal-sm px-2">→</span>
                        <span>{{ $step }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- TIMESTAMP -->
        <p class="text-sm mt-6 text-gray-500">
            Generated on {{ $latest->created_at->format('d M Y, h:i A') }}
        </p>

    </div>
    </a>

    @else

    <!-- 🪫 EMPTY STATE -->
    <div class="brutal p-10 text-center">

        <h2 class="text-2xl font-bold mb-4">
            No recommendations yet
        </h2>

        <p class="mb-6">
            Build your profile to unlock AI career insights.
        </p>

        <a href="{{ route('career.create') }}"
           class="brutal-btn bg-green-300 px-6 py-3 font-bold">
            START →
        </a>

    </div>

    @endif


    <!-- 📜 HISTORY -->
    <h2 class="text-2xl font-bold mt-12 mb-6">History</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($history as $item)
        <a href="{{ route('career.show', $item->id) }}">

            <div class="brutal p-5 bg-white hover:-translate-y-1 transition">

                <h3 class="text-lg font-bold">
                    {{ $item->career_name }}
                </h3>

                <p class="text-sm mt-2">
                    {{ $item->description }}
                </p>

                <p class="text-xs mt-4 text-gray-500">
                    {{ $item->created_at->format('d M Y') }}
                </p>

            </div>

        </a>
        @endforeach

    </div>

</div>


<!-- 🤖 CHAT ASSISTANT -->
<div class="fixed bottom-6 right-6 w-80 brutal bg-white">

    <div class="p-3 font-bold border-b border-black">
        Assistant
    </div>

    <div id="chat-box" class="h-64 overflow-y-auto p-3 space-y-2"></div>

    <div class="p-2 border-t border-black">
        <input id="chat-input" type="text"
            class="w-full p-2 brutal-sm"
            placeholder="Ask something...">
    </div>

</div>


<script>
document.getElementById('chat-input').addEventListener('keypress', async function(e) {
    if (e.key === 'Enter') {

        let msg = this.value.trim();
        if (!msg) return;

        this.value = '';

        let box = document.getElementById('chat-box');

        box.innerHTML += `
            <div class="text-right">
                <span class="bg-black text-white px-3 py-1 inline-block">
                    ${msg}
                </span>
            </div>
        `;

        let res = await fetch('/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: msg })
        });

        let data = await res.json();

        box.innerHTML += `
            <div>
                <span class="bg-gray-200 px-3 py-1 inline-block">
                    ${data.reply}
                </span>
            </div>
        `;

        box.scrollTop = box.scrollHeight;
    }
});
</script>

</x-app-layout>