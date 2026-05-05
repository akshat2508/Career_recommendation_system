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

            <!-- 🧠 Skill Gap Analysis -->
            <div class="mt-8 bg-white text-black p-6 rounded-xl">

                <h3 class="text-xl font-semibold mb-4">Skill Gap Analysis</h3>

                <!-- ✅ Matched Skills -->
                <div class="mb-4">
                    <h4 class="font-semibold text-green-600 mb-2">You Already Have</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($career->required_skills as $skill)
                        @if(in_array($skill, $userSkills))
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            {{ $skill }}
                        </span>
                        @endif
                        @endforeach
                    </div>
                </div>

                <!-- ❌ Missing Skills -->
                <div>
                    <h4 class="font-semibold text-red-600 mb-2">You Need to Learn</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($career->required_skills as $skill)
                        @if(!in_array($skill, $userSkills))
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                            {{ $skill }}
                        </span>
                        @endif
                        @endforeach
                    </div>
                </div>

            </div>
            <!-- 🎯 Match Score -->
<div class="mt-6 bg-white text-black p-6 rounded-xl">

    <h3 class="text-xl font-semibold mb-4">Career Match Score</h3>

    <div class="flex items-center justify-between mb-2">
        <span class="font-medium">Your Fit</span>
        <span class="font-bold text-lg">{{ $matchScore }}%</span>
    </div>

    <!-- Progress Bar -->
    <div class="w-full bg-gray-200 rounded-full h-3">
        <div class="bg-blue-600 h-3 rounded-full" 
             style="width: {{ $matchScore }}%"></div>
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