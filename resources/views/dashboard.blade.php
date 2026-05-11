<x-app-layout>
@php
    $personality = auth()->user()->profile->personality ?? [];
    arsort($personality);
    $topTraits = array_keys(array_slice($personality, 0, 2));

    function getPersonalityTitle($traits) {
        $map = [
            'analytical_structured' => 'System Thinker',
            'structured_analytical' => 'System Thinker',
            'creative_social'       => 'Creative Collaborator',
            'social_creative'       => 'Creative Collaborator',
            'analytical_creative'   => 'Innovative Problem Solver',
            'creative_analytical'   => 'Innovative Problem Solver',
            'social_structured'     => 'Organized Leader',
            'structured_social'     => 'Organized Leader',
        ];
        $key = implode('_', $traits);
        return $map[$key] ?? 'Balanced Individual';
    }

    $personalityTitle = getPersonalityTitle($topTraits);
    $hasPersonality   = auth()->user()->profile && auth()->user()->profile->personality;
@endphp

<div class="min-h-screen bg-[#f5f5f0]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- ─────────────────────────────────────────
             HEADER
        ───────────────────────────────────────── --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-4xl font-black mb-1 tracking-tight">Career Dashboard</h1>
                <p class="text-gray-600 text-sm">Your personalized AI-powered career insights</p>
            </div>
            <a href="{{ $hasPersonality ? route('career.create') : route('personality') }}"
               class="brutal-btn bg-black text-white px-6 py-3 font-bold text-center whitespace-nowrap">
                + NEW ANALYSIS
            </a>
        </div>

        {{-- ─────────────────────────────────────────
             ROW 1 — Personality  |  Top Match
        ───────────────────────────────────────── --}}
        @if(count($topTraits) > 0 || $best)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">

            {{-- PERSONALITY CARD --}}
            @if(count($topTraits) > 0)
            <div class="brutal bg-gradient-to-br from-blue-400 to-blue-500 p-7 relative overflow-hidden">
                <div class="absolute -top-8 -right-8 w-32 h-32 bg-white opacity-10 rounded-full"></div>

                <div class="inline-block brutal-sm bg-white px-3 py-1 mb-4">
                    <p class="text-xs font-black tracking-wider">YOUR PROFILE TYPE</p>
                </div>

                <h2 class="text-2xl font-black text-white mb-3">{{ $personalityTitle }}</h2>

                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($topTraits as $trait)
                        <span class="brutal-sm bg-white px-3 py-1 font-bold text-sm">
                            {{ ucfirst($trait) }}
                        </span>
                    @endforeach
                </div>

                <p class="text-white text-xs leading-relaxed">
                    Recommendations matched to your unique personality and skill profile.
                </p>
            </div>
            @endif

            {{-- TOP MATCH CARD --}}
            @if($best)
            <div class="brutal bg-gradient-to-br from-yellow-300 to-yellow-400 p-7 relative overflow-hidden">
                <div class="absolute top-0 right-3 text-yellow-500 opacity-20 text-8xl font-black leading-none select-none">★</div>

                <div class="inline-block brutal-sm bg-black text-white px-3 py-1 mb-4">
                    <p class="text-xs font-black tracking-wider">🏆 TOP MATCH</p>
                </div>

                <h2 class="text-2xl font-black mb-3 leading-tight">{{ $best->career_name }}</h2>

                <p class="text-sm leading-relaxed mb-5 max-w-xs">
                    {{ Str::limit($best->description, 120) }}
                </p>

                <div class="brutal-sm bg-black text-white px-5 py-2 inline-block">
                    <span class="text-2xl font-black">{{ $best->matchScore }}%</span>
                    <span class="text-xs ml-1">MATCH</span>
                </div>
            </div>
            @endif

        </div>
        @endif

        {{-- ─────────────────────────────────────────
             ROW 2 — Latest Analysis (full-width)
        ───────────────────────────────────────── --}}
        @if($latest && (!$best || $latest->id !== $best->id))

        <div class="mb-5">

            <div class="flex items-center gap-3 mb-3">
                <span class="brutal-sm bg-green-300 px-3 py-1 text-xs font-black tracking-wider">LATEST</span>
                <h2 class="text-xl font-black">Analysis</h2>
            </div>

            <a href="{{ route('career.show', $latest->id) }}" class="block">
                <div class="brutal bg-white p-7 hover:translate-x-1 hover:translate-y-1 transition-transform cursor-pointer">

                    <h3 class="text-3xl font-black mb-2">{{ $latest->career_name }}</h3>
                    <p class="text-gray-700 text-sm leading-relaxed mb-6">{{ $latest->description }}</p>

                    @php
                        $required       = array_map(fn($s) => strtolower(trim($s)), $latest->required_skills ?? []);
                        $userSkillsLower = array_map(fn($s) => strtolower(trim($s)), $userSkills ?? []);
                        $matched        = array_intersect($required, $userSkillsLower);
                        $matchScore     = count($required) > 0
                                            ? round((count($matched) / count($required)) * 100)
                                            : 0;
                        $missing        = array_filter(
                                            $latest->required_skills ?? [],
                                            fn($s) => !in_array(strtolower(trim($s)), $userSkillsLower)
                                          );
                    @endphp

                    {{-- MATCH SCORE BAR --}}
                    <div class="mb-6">
                        <div class="flex justify-between items-baseline mb-2">
                            <span class="font-black text-xs tracking-wider">MATCH SCORE</span>
                            <span class="font-black text-2xl">{{ $matchScore }}%</span>
                        </div>
                        <div class="w-full h-4 bg-gray-200 brutal-sm overflow-hidden">
                            <div class="h-full bg-black transition-all duration-500" style="width: {{ $matchScore }}%"></div>
                        </div>
                    </div>

                    {{-- TWO-COLUMN DETAILS --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                        {{-- LEFT --}}
                        <div class="space-y-4">

                            @if(!empty($latest->why_fit))
                            <div class="brutal-sm bg-blue-50 p-4">
                                <p class="text-xs font-black mb-2 tracking-wider text-blue-900">WHY THIS FITS YOU</p>
                                <p class="text-sm leading-relaxed">{{ $latest->why_fit }}</p>
                            </div>
                            @endif

                            @if(!empty($topTraits))
                            <div class="brutal-sm bg-purple-50 p-4">
                                <p class="text-xs font-black mb-2 tracking-wider text-purple-900">PERSONALITY MATCH</p>
                                <p class="text-sm leading-relaxed">
                                    This role aligns with your
                                    <strong>{{ implode(' + ', $topTraits) }}</strong> traits.
                                </p>
                            </div>
                            @endif

                        </div>

                        {{-- RIGHT --}}
                        <div class="space-y-4">

                            @if(!empty($latest->required_skills))
                            <div>
                                <p class="font-black text-xs mb-3 tracking-wider">REQUIRED SKILLS</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($latest->required_skills as $skill)
                                        <span class="brutal-sm px-3 py-2 text-xs font-bold bg-gray-100">
                                            {{ ucfirst($skill) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div>
                                <p class="font-black text-xs mb-3 tracking-wider">SKILL GAP ANALYSIS</p>
                                @if(count($missing) > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($missing as $skill)
                                            <span class="brutal-sm px-3 py-2 text-xs font-bold bg-red-100 text-red-900">
                                                {{ ucfirst($skill) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="brutal-sm bg-green-100 p-3 text-center">
                                        <p class="text-sm font-bold text-green-900">🎯 You're fully aligned!</p>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>

                    {{-- ROADMAP --}}
                    @if(!empty($latest->roadmap))
                    <div class="border-t-4 border-black pt-6">
                        <p class="font-black text-xs mb-4 tracking-wider">YOUR ROADMAP</p>
                        <div class="space-y-3">
                            @foreach($latest->roadmap as $index => $step)
                                <div class="flex items-start gap-4">
                                    <div class="brutal-sm bg-black text-white w-8 h-8 flex items-center justify-center font-bold flex-shrink-0">
                                        {{ $index + 1 }}
                                    </div>
                                    <p class="text-sm leading-relaxed pt-1">{{ $step }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- TIMESTAMP --}}
                    <div class="border-t-2 border-gray-200 mt-6 pt-4">
                        <p class="text-xs text-gray-500 font-mono">
                            Generated on {{ $latest->created_at->format('d M Y, h:i A') }}
                        </p>
                    </div>

                </div>
            </a>
        </div>

        @elseif(!$best)

        {{-- EMPTY STATE --}}
        <div class="brutal bg-white p-16 text-center mb-5">
            <div class="inline-block mb-6">
                <div class="w-24 h-24 bg-gray-200 brutal flex items-center justify-center text-5xl">📊</div>
            </div>
            <h2 class="text-3xl font-black mb-4">No Recommendations Yet</h2>
            <p class="text-gray-600 mb-8 max-w-md mx-auto text-sm">
                Build your profile and unlock AI-powered career insights tailored specifically for you.
            </p>
            <a href="{{ $hasPersonality ? route('career.create') : route('personality') }}"
               class="brutal-btn bg-green-400 px-8 py-4 font-black text-lg inline-block">
                START CAREER ANALYSIS →
            </a>
        </div>

        @endif

        {{-- ─────────────────────────────────────────
             HISTORY — collapsed by default
        ───────────────────────────────────────── --}}
        <div class="mt-4">

            {{-- Toggle button --}}
            <button
                onclick="toggleHistory()"
                id="hist-btn"
                class="brutal-btn bg-white w-full px-6 py-4 flex items-center justify-between font-black text-base"
            >
                <div class="flex items-center gap-3">
                    <span>Other Analysis</span>
                    <span class="brutal-sm bg-gray-200 px-3 py-1 text-xs font-black">
                        {{ count($history) }} {{ count($history) === 1 ? 'ANALYSIS' : 'ANALYSES' }}
                    </span>
                </div>
                <svg id="hist-chevron"
                     class="w-5 h-5 transition-transform duration-300"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            {{-- History panel (hidden by default) --}}
            <div id="hist-panel" class="hidden mt-4">

                @if(count($history) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($history as $item)
                    <a href="{{ route('career.show', $item->id) }}" class="block group">
                        <div class="brutal bg-white p-6 h-full hover:translate-x-1 hover:translate-y-1 transition-transform">

                            <div class="brutal-sm bg-gray-100 px-2 py-1 inline-block mb-3">
                                <p class="text-xs font-bold text-gray-600">
                                    {{ $item->created_at->format('d M Y') }}
                                </p>
                            </div>

                            <h3 class="text-xl font-black mb-3 group-hover:text-blue-600 transition-colors">
                                {{ $item->career_name }}
                            </h3>

                            <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                {{ $item->description }}
                            </p>

                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="brutal bg-gray-100 p-12 text-center mt-2">
                    <p class="text-gray-500 text-sm">No history available yet</p>
                </div>
                @endif

            </div>
        </div>

    </div>
</div>

{{-- ─────────────────────────────────────────
     FLOATING CHAT ASSISTANT
───────────────────────────────────────── --}}
<div class="fixed bottom-6 right-6 w-96 max-w-[calc(100vw-3rem)] brutal bg-white shadow-2xl z-50">

    <div class="brutal-sm bg-black text-white p-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
            <span class="font-black text-sm tracking-wider">AI ASSISTANT</span>
        </div>
        <button onclick="document.querySelector('.chat-container').classList.toggle('hidden')"
                class="text-white hover:text-gray-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
    </div>

    <div class="chat-container">
        <div id="chat-box" class="h-80 overflow-y-auto p-4 space-y-3 bg-gray-50">
            <div class="brutal-sm bg-white p-3 max-w-[80%]">
                <p class="text-sm">👋 Hi! I'm here to help with your career journey. Ask me anything!</p>
            </div>
        </div>

        <div class="p-3 border-t-4 border-black bg-white">
            <div class="flex gap-2">
                <input id="chat-input"
                       type="text"
                       class="flex-1 p-3 brutal-sm font-medium focus:outline-none focus:ring-2 focus:ring-black"
                       placeholder="Type your question...">
                <button onclick="sendMessage()"
                        class="brutal-btn bg-black text-white px-4 py-3 font-bold hover:bg-gray-800">
                    →
                </button>
            </div>
        </div>
    </div>

</div>

{{-- ─────────────────────────────────────────
     SCRIPTS
───────────────────────────────────────── --}}
<script>
/* History toggle */
function toggleHistory() {
    const panel  = document.getElementById('hist-panel');
    const chev   = document.getElementById('hist-chevron');
    const isOpen = !panel.classList.contains('hidden');

    panel.classList.toggle('hidden', isOpen);
    chev.style.transform = isOpen ? '' : 'rotate(180deg)';
}

/* Chat */
function sendMessage() {
    const input = document.getElementById('chat-input');
    const msg   = input.value.trim();
    if (!msg) return;

    input.value = '';
    const box = document.getElementById('chat-box');

    box.innerHTML += `
        <div class="flex justify-end">
            <div class="brutal-sm bg-black text-white px-4 py-3 max-w-[80%]">
                <p class="text-sm">${msg}</p>
            </div>
        </div>`;

    const loadingId = 'loading-' + Date.now();
    box.innerHTML += `
        <div id="${loadingId}" class="brutal-sm bg-white p-3 max-w-[80%]">
            <p class="text-sm text-gray-500">Thinking...</p>
        </div>`;

    box.scrollTop = box.scrollHeight;

    fetch('/chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message: msg })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById(loadingId)?.remove();
        box.innerHTML += `
    <div class="brutal-sm bg-white p-4 max-w-[80%] ai-response">
        ${data.reply}
    </div>`;
        box.scrollTop = box.scrollHeight;
    })
    .catch(() => {
        document.getElementById(loadingId)?.remove();
        box.innerHTML += `
            <div class="brutal-sm bg-red-100 p-3 max-w-[80%]">
                <p class="text-sm text-red-800">Error: Could not send message</p>
            </div>`;
    });
}

document.getElementById('chat-input').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') sendMessage();
});
</script>

{{-- ─────────────────────────────────────────
     STYLES
───────────────────────────────────────── --}}
<style>
.brutal {
    border: 4px solid black;
    box-shadow: 8px 8px 0 0 rgba(0,0,0,1);
}
.brutal-sm {
    border: 3px solid black;
    box-shadow: 4px 4px 0 0 rgba(0,0,0,1);
}
.brutal-btn {
    border: 4px solid black;
    box-shadow: 6px 6px 0 0 rgba(0,0,0,1);
    transition: all .2s;
    display: inline-block;
}
.brutal-btn:hover {
    box-shadow: 8px 8px 0 0 rgba(0,0,0,1);
}
.brutal-btn:active {
    box-shadow: 2px 2px 0 0 rgba(0,0,0,1);
    transform: translate(4px,4px);
}
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
@media (max-width: 640px) {
    .brutal {
        border-width: 3px;
        box-shadow: 5px 5px 0 0 rgba(0,0,0,1);
    }
}
.ai-response {
    line-height: 1.8;
    font-size: 14px;
    overflow-wrap: break-word;
}

.ai-response h2 {
    font-size: 20px;
    font-weight: 900;
    margin-top: 12px;
    margin-bottom: 10px;
}

.ai-response h3 {
    font-size: 16px;
    font-weight: 800;
    margin-top: 10px;
    margin-bottom: 8px;
}

.ai-response p {
    margin-bottom: 10px;
    color: #111827;
}

.ai-response ul {
    padding-left: 20px;
    margin-bottom: 12px;
}

.ai-response li {
    margin-bottom: 6px;
}

.ai-response strong {
    font-weight: 800;
}

.ai-response br {
    margin-bottom: 8px;
}
</style>

</x-app-layout>