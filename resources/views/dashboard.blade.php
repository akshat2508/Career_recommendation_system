<x-app-layout>
@php
    $personality = auth()->user()->profile->personality ?? [];
    arsort($personality);
    $topTraits = array_keys(array_slice($personality, 0, 2));

    function getPersonalityTitle($traits) {
        $map = [
            'analytical_structured' => 'System Thinker',
            'structured_analytical' => 'System Thinker',
            'creative_social' => 'Creative Collaborator',
            'social_creative' => 'Creative Collaborator',
            'analytical_creative' => 'Innovative Problem Solver',
            'creative_analytical' => 'Innovative Problem Solver',
            'social_structured' => 'Organized Leader',
            'structured_social' => 'Organized Leader',
        ];

        $key = implode('_', $traits);
        return $map[$key] ?? 'Balanced Individual';
    }

    $personalityTitle = getPersonalityTitle($topTraits);
@endphp

<div class="min-h-screen bg-[#f5f5f0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- HEADER SECTION -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-black mb-2 tracking-tight">Career Dashboard</h1>
                    <p class="text-gray-600">Your personalized AI-powered career insights</p>
                </div>
                
                @php
                    $hasPersonality = auth()->user()->profile && auth()->user()->profile->personality;
                @endphp
                
                <a href="{{ $hasPersonality ? route('career.create') : route('personality') }}"
                   class="brutal-btn bg-black text-white px-6 py-3 font-bold text-center hover:translate-x-1 hover:translate-y-1 transition-transform">
                    + NEW ANALYSIS
                </a>
            </div>
        </div>

        <!-- PERSONALITY PROFILE CARD -->
        @if(count($topTraits) > 0)
        <div class="brutal bg-gradient-to-br from-blue-400 to-blue-500 p-8 mb-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-black opacity-10 rounded-full -ml-24 -mb-24"></div>
            
            <div class="relative z-10">
                <div class="inline-block brutal-sm bg-white px-3 py-1 mb-4">
                    <p class="text-xs font-black tracking-wider">YOUR PROFILE TYPE</p>
                </div>
                
                <h2 class="text-3xl sm:text-4xl font-black text-white mb-3">
                    {{ $personalityTitle }}
                </h2>
                
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($topTraits as $trait)
                    <span class="brutal-sm bg-white px-4 py-2 font-bold text-sm">
                        {{ ucfirst($trait) }}
                    </span>
                    @endforeach
                </div>
                
                <p class="text-white text-sm max-w-2xl">
                    Your recommendations are intelligently matched based on your unique personality traits and skill profile.
                </p>
            </div>
        </div>
        @endif

        <!-- TOP MATCH SECTION -->
        @if($best)
        <div class="brutal bg-gradient-to-br from-yellow-300 to-yellow-400 p-8 mb-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 text-yellow-500 opacity-20 text-9xl font-black">★</div>
            
            <div class="relative z-10">
                <div class="inline-block brutal-sm bg-black text-white px-3 py-1 mb-4">
                    <p class="text-xs font-black tracking-wider">🏆 TOP MATCH</p>
                </div>
                
                <h1 class="text-4xl sm:text-5xl font-black mb-4 leading-tight">
                    {{ $best->career_name }}
                </h1>
                
                <p class="text-lg max-w-3xl mb-6 leading-relaxed">
                    {{ $best->description }}
                </p>
                
                <div class="inline-block brutal bg-black text-white px-6 py-3">
                    <span class="text-3xl font-black">{{ $best->matchScore }}%</span>
                    <span class="text-sm ml-2">MATCH</span>
                </div>
            </div>
        </div>
        @endif

        <!-- LATEST RECOMMENDATION -->
        @if($latest && (!$best || $latest->id !== $best->id))
        <div class="mb-8">
            <h2 class="text-2xl font-black mb-4 flex items-center gap-2">
                <span class="brutal-sm bg-green-300 px-3 py-1 text-sm">LATEST</span>
                Analysis
            </h2>
            
            <a href="{{ route('career.show', $latest->id) }}" class="block">
                <div class="brutal bg-white p-8 hover:translate-x-1 hover:translate-y-1 transition-transform cursor-pointer">
                    
                    <h3 class="text-3xl font-black mb-3">
                        {{ $latest->career_name }}
                    </h3>
                    
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        {{ $latest->description }}
                    </p>

                    @php
                        $required = array_map(fn($s) => strtolower(trim($s)), $latest->required_skills ?? []);
                        $userSkillsLower = array_map(fn($s) => strtolower(trim($s)), $userSkills ?? []);
                        $matched = array_intersect($required, $userSkillsLower);
                        $matchScore = count($required) > 0 ? round((count($matched)/count($required))*100) : 0;
                    @endphp

                    <!-- MATCH SCORE BAR -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-bold text-sm">MATCH SCORE</span>
                            <span class="font-black text-2xl">{{ $matchScore }}%</span>
                        </div>
                        <div class="w-full h-4 bg-gray-200 brutal-sm relative overflow-hidden">
                            <div class="h-full bg-black transition-all duration-500" style="width: {{ $matchScore }}%"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <!-- LEFT COLUMN -->
                        <div class="space-y-6">
                            
                            <!-- WHY FIT -->
                            @if(!empty($latest->why_fit))
                            <div class="brutal-sm bg-blue-50 p-5">
                                <p class="text-xs font-black mb-2 tracking-wider text-blue-900">WHY THIS FITS YOU</p>
                                <p class="text-sm leading-relaxed">
                                    {{ $latest->why_fit }}
                                </p>
                            </div>
                            @endif

                            <!-- PERSONALITY MATCH -->
                            @if(!empty($topTraits))
                            <div class="brutal-sm bg-purple-50 p-5">
                                <p class="text-xs font-black mb-2 tracking-wider text-purple-900">PERSONALITY MATCH</p>
                                <p class="text-sm leading-relaxed">
                                    This role aligns perfectly with your <strong>{{ implode(' + ', $topTraits) }}</strong> traits.
                                </p>
                            </div>
                            @endif

                        </div>

                        <!-- RIGHT COLUMN -->
                        <div class="space-y-6">
                            
                            <!-- REQUIRED SKILLS -->
                            @if(!empty($latest->required_skills))
                            <div>
                                <p class="font-black mb-3 text-sm tracking-wider">REQUIRED SKILLS</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($latest->required_skills as $skill)
                                        <span class="brutal-sm px-3 py-2 text-xs font-bold bg-gray-100 hover:bg-gray-200 transition-colors">
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

                            <div>
                                <p class="font-black mb-3 text-sm tracking-wider">SKILL GAP ANALYSIS</p>
                                
                                @if(count($missing) > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($missing as $skill)
                                            <span class="brutal-sm px-3 py-2 text-xs font-bold bg-red-100 text-red-900">
                                                {{ ucfirst($skill) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="brutal-sm bg-green-100 p-4 text-center">
                                        <p class="text-sm font-bold text-green-900">🎯 You're fully aligned!</p>
                                    </div>
                                @endif
                            </div>

                        </div>

                    </div>

                    <!-- ROADMAP -->
                    @if(!empty($latest->roadmap))
                    <div class="mt-6 pt-6 border-t-4 border-black">
                        <p class="font-black mb-4 text-sm tracking-wider">YOUR ROADMAP</p>
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

                    <!-- TIMESTAMP -->
                    <div class="mt-6 pt-6 border-t-2 border-gray-200">
                        <p class="text-xs text-gray-500 font-mono">
                            Generated on {{ $latest->created_at->format('d M Y, h:i A') }}
                        </p>
                    </div>

                </div>
            </a>
        </div>

        @else

        <!-- EMPTY STATE -->
        <div class="brutal bg-white p-16 text-center mb-8">
            
            <div class="inline-block mb-6">
                <div class="w-24 h-24 bg-gray-200 brutal flex items-center justify-center text-5xl">
                    📊
                </div>
            </div>
            
            <h2 class="text-3xl font-black mb-4">
                No Recommendations Yet
            </h2>
            
            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                Build your profile and unlock AI-powered career insights tailored specifically for you.
            </p>

            @php
                $hasPersonality = auth()->user()->profile && auth()->user()->profile->personality;
            @endphp

            <a href="{{ $hasPersonality ? route('career.create') : route('personality') }}"
               class="brutal-btn bg-green-400 px-8 py-4 font-black text-lg inline-block hover:translate-x-1 hover:translate-y-1 transition-transform">
                START CAREER ANALYSIS →
            </a>

        </div>

        @endif

        <!-- HISTORY SECTION -->
        <div class="mt-16">
            
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-black">History</h2>
                <div class="brutal-sm bg-gray-200 px-4 py-2 font-bold text-sm">
                    {{ count($history) }} ANALYSIS
                </div>
            </div>

            @if(count($history) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
            <div class="brutal bg-gray-100 p-12 text-center">
                <p class="text-gray-500">No history available yet</p>
            </div>
            @endif

        </div>

    </div>
</div>

<!-- FLOATING CHAT ASSISTANT -->
<div class="fixed bottom-6 right-6 w-96 max-w-[calc(100vw-3rem)] brutal bg-white shadow-2xl z-50">
    
    <div class="brutal-sm bg-black text-white p-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
            <span class="font-black text-sm tracking-wider">AI ASSISTANT</span>
        </div>
        <button onclick="document.querySelector('.chat-container').classList.toggle('hidden')" class="text-white hover:text-gray-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
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
                <button onclick="sendMessage()" class="brutal-btn bg-black text-white px-4 py-3 font-bold hover:bg-gray-800">
                    →
                </button>
            </div>
        </div>
    </div>

</div>

<script>
function sendMessage() {
    const input = document.getElementById('chat-input');
    const msg = input.value.trim();
    
    if (!msg) return;
    
    input.value = '';
    const box = document.getElementById('chat-box');
    
    // User message
    box.innerHTML += `
        <div class="flex justify-end">
            <div class="brutal-sm bg-black text-white px-4 py-3 max-w-[80%]">
                <p class="text-sm">${msg}</p>
            </div>
        </div>
    `;
    
    // Loading indicator
    const loadingId = 'loading-' + Date.now();
    box.innerHTML += `
        <div id="${loadingId}" class="brutal-sm bg-white p-3 max-w-[80%]">
            <p class="text-sm text-gray-500">Thinking...</p>
        </div>
    `;
    
    box.scrollTop = box.scrollHeight;
    
    // Send request
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
        document.getElementById(loadingId).remove();
        
        box.innerHTML += `
            <div class="brutal-sm bg-white p-3 max-w-[80%]">
                <p class="text-sm">${data.reply}</p>
            </div>
        `;
        
        box.scrollTop = box.scrollHeight;
    })
    .catch(error => {
        document.getElementById(loadingId).remove();
        
        box.innerHTML += `
            <div class="brutal-sm bg-red-100 p-3 max-w-[80%]">
                <p class="text-sm text-red-800">Error: Could not send message</p>
            </div>
        `;
    });
}

// Enter key handler
document.getElementById('chat-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});
</script>

<style>
/* Brutalist utility classes */
.brutal {
    border: 4px solid black;
    box-shadow: 8px 8px 0 0 rgba(0, 0, 0, 1);
}

.brutal-sm {
    border: 3px solid black;
    box-shadow: 4px 4px 0 0 rgba(0, 0, 0, 1);
}

.brutal-btn {
    border: 4px solid black;
    box-shadow: 6px 6px 0 0 rgba(0, 0, 0, 1);
    transition: all 0.2s;
}

.brutal-btn:hover {
    box-shadow: 8px 8px 0 0 rgba(0, 0, 0, 1);
}

.brutal-btn:active {
    box-shadow: 2px 2px 0 0 rgba(0, 0, 0, 1);
    transform: translate(4px, 4px);
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
        box-shadow: 5px 5px 0 0 rgba(0, 0, 0, 1);
    }
}
</style>

</x-app-layout>