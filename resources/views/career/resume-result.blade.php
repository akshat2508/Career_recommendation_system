<x-app-layout>

@php

$topCareer = collect($analysis['career_matches'] ?? [])->sortByDesc('match_percentage')->first();

$frontendSkills = [
    'React', 'Angular', 'JavaScript', 'TypeScript',
    'HTML/CSS', 'Tailwind CSS', 'Next.js'
];

$backendSkills = [
    'Node.js', 'Express', 'REST APIs',
    'PostgreSQL', 'MongoDB', 'Redis', 'GraphQL'
];

$devopsSkills = [
    'Docker', 'CI/CD', 'AWS (EC2, S3)',
    'Kubernetes', 'Terraform', 'Jenkins'
];

$mobileSkills = [
    'Flutter', 'React Native'
];

$allSkills = collect($analysis['detected_skills'] ?? []);

function hasSkill($skills, $skill)
{
    return collect($skills)->contains(function ($s) use ($skill) {
        return strtolower(trim($s)) === strtolower(trim($skill));
    });
}

$roleSkillGaps = [

    [
        'role' => 'Backend Engineer',
        'match' => 84,
        'missing' => [
            'Redis',
            'GraphQL',
            'Unit Testing',
            'Microservices',
        ]
    ],

    [
        'role' => 'DevOps Engineer',
        'match' => 62,
        'missing' => [
            'Kubernetes',
            'Terraform',
            'Jenkins',
            'Monitoring Stack',
        ]
    ],

    [
        'role' => 'Cloud Engineer',
        'match' => 58,
        'missing' => [
            'AWS IAM',
            'Load Balancing',
            'Azure',
            'GCP',
        ]
    ],

    [
        'role' => 'Frontend Engineer',
        'match' => 78,
        'missing' => [
            'Performance Profiling',
            'Unit Testing',
            'Accessibility',
        ]
    ],
];

@endphp

<div class="space-y-8 pb-10">

    {{-- HERO SECTION --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-gradient-to-br from-green-200 to-green-300 border-4 border-black shadow-[8px_8px_0px_#000] p-8 rounded-2xl">

            <p class="text-sm font-semibold uppercase tracking-widest mb-2">
                ATS SCORE
            </p>

            <h1 class="text-5xl font-black">
                {{ $analysis['ats_score'] ?? 0 }}
                <span class="text-2xl">/100</span>
            </h1>

            <div class="mt-4 bg-black/10 rounded-full h-4 overflow-hidden">
                <div
                    class="bg-black h-full"
                    style="width: {{ $analysis['ats_score'] ?? 0 }}%"
                ></div>
            </div>

        </div>

        <div class="bg-gradient-to-br from-blue-200 to-blue-300 border-4 border-black shadow-[8px_8px_0px_#000] p-8 rounded-2xl">

            <p class="text-sm font-semibold uppercase tracking-widest mb-2">
                BEST CAREER MATCH
            </p>

            <h2 class="text-3xl font-black leading-tight">
                {{ $topCareer['role'] ?? 'Full Stack Engineer' }}
            </h2>

            <p class="mt-4 text-lg font-semibold">
                {{ $topCareer['match_percentage'] ?? 90 }}% Match
            </p>

            <p class="mt-4 text-sm leading-relaxed">
                Strong production-level full stack development,
                backend APIs, cloud exposure, and deployment experience.
            </p>

        </div>

        <div class="bg-gradient-to-br from-yellow-200 to-orange-200 border-4 border-black shadow-[8px_8px_0px_#000] p-8 rounded-2xl">

            <p class="text-sm font-semibold uppercase tracking-widest mb-2">
                EXPERIENCE LEVEL
            </p>

            <h2 class="text-3xl font-black leading-tight">
                Intermediate
                Engineer
            </h2>

            <ul class="mt-4 space-y-2 text-sm font-medium">
                <li>✔ Production Projects</li>
                <li>✔ Internship Experience</li>
                <li>✔ Cloud Exposure</li>
                <li>✔ Multi-stack Development</li>
            </ul>

        </div>

    </div>


    {{-- ATS BREAKDOWN --}}
    <div class="bg-white border-4 border-black shadow-[8px_8px_0px_#000] rounded-2xl p-8">

        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-black">
                    ATS Breakdown
                </h2>

                <p class="text-gray-600 mt-2">
                    Detailed resume scoring based on recruiter expectations.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            @php
                $atsSections = [
                    ['title' => 'Keywords Match', 'score' => 92],
                    ['title' => 'Project Quality', 'score' => 88],
                    ['title' => 'Technical Depth', 'score' => 84],
                    ['title' => 'Impact Metrics', 'score' => 80],
                    ['title' => 'Formatting', 'score' => 72],
                    ['title' => 'Industry Alignment', 'score' => 86],
                ];
            @endphp

            @foreach($atsSections as $section)

                <div>

                    <div class="flex justify-between mb-2 font-bold">
                        <span>{{ $section['title'] }}</span>
                        <span>{{ $section['score'] }}%</span>
                    </div>

                    <div class="h-4 bg-gray-200 rounded-full overflow-hidden border-2 border-black">
                        <div
                            class="h-full bg-black"
                            style="width: {{ $section['score'] }}%"
                        ></div>
                    </div>

                </div>

            @endforeach

        </div>

    </div>


    {{-- SKILL MATRIX --}}
    <div class="bg-white border-4 border-black shadow-[8px_8px_0px_#000] rounded-2xl p-8">

        <h2 class="text-3xl font-black mb-8">
            Skill Intelligence Matrix
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- FRONTEND --}}
            <div>
                <h3 class="text-xl font-black mb-4">
                    Frontend
                </h3>

                <div class="flex flex-wrap gap-3">

                    @foreach($frontendSkills as $skill)

                        @if(hasSkill($allSkills, $skill))

                            <span class="px-4 py-2 rounded-xl bg-green-200 border-2 border-black font-semibold">
                                ✔ {{ $skill }}
                            </span>

                        @else

                            <span class="px-4 py-2 rounded-xl bg-red-100 border-2 border-black font-semibold opacity-70">
                                ✘ {{ $skill }}
                            </span>

                        @endif

                    @endforeach

                </div>
            </div>

            {{-- BACKEND --}}
            <div>
                <h3 class="text-xl font-black mb-4">
                    Backend
                </h3>

                <div class="flex flex-wrap gap-3">

                    @foreach($backendSkills as $skill)

                        @if(hasSkill($allSkills, $skill))

                            <span class="px-4 py-2 rounded-xl bg-green-200 border-2 border-black font-semibold">
                                ✔ {{ $skill }}
                            </span>

                        @else

                            <span class="px-4 py-2 rounded-xl bg-red-100 border-2 border-black font-semibold opacity-70">
                                ✘ {{ $skill }}
                            </span>

                        @endif

                    @endforeach

                </div>
            </div>

            {{-- DEVOPS --}}
            <div>
                <h3 class="text-xl font-black mb-4">
                    DevOps & Cloud
                </h3>

                <div class="flex flex-wrap gap-3">

                    @foreach($devopsSkills as $skill)

                        @if(hasSkill($allSkills, $skill))

                            <span class="px-4 py-2 rounded-xl bg-green-200 border-2 border-black font-semibold">
                                ✔ {{ $skill }}
                            </span>

                        @else

                            <span class="px-4 py-2 rounded-xl bg-red-100 border-2 border-black font-semibold opacity-70">
                                ✘ {{ $skill }}
                            </span>

                        @endif

                    @endforeach

                </div>
            </div>

            {{-- MOBILE --}}
            <div>
                <h3 class="text-xl font-black mb-4">
                    Mobile Development
                </h3>

                <div class="flex flex-wrap gap-3">

                    @foreach($mobileSkills as $skill)

                        @if(hasSkill($allSkills, $skill))

                            <span class="px-4 py-2 rounded-xl bg-green-200 border-2 border-black font-semibold">
                                ✔ {{ $skill }}
                            </span>

                        @else

                            <span class="px-4 py-2 rounded-xl bg-red-100 border-2 border-black font-semibold opacity-70">
                                ✘ {{ $skill }}
                            </span>

                        @endif

                    @endforeach

                </div>
            </div>

        </div>

    </div>


    {{-- CAREER MATCHES --}}
    <div class="space-y-6">

        <div>
            <h2 class="text-3xl font-black">
                AI Career Matches
            </h2>

            <p class="text-gray-600 mt-2">
                Roles best aligned with your current profile.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @foreach(($analysis['career_matches'] ?? []) as $career)

                <div class="bg-white border-4 border-black shadow-[8px_8px_0px_#000] rounded-2xl p-6 hover:-translate-y-1 transition-all">

                    <div class="flex items-start justify-between">

                        <div>
                            <h3 class="text-2xl font-black">
                                {{ $career['role'] }}
                            </h3>

                            <p class="text-gray-600 mt-2 text-sm">
                                Strong alignment with your production-level
                                projects and engineering stack.
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-4xl font-black">
                                {{ $career['match_percentage'] }}%
                            </p>
                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>


    {{-- ROLE BASED SKILL GAPS --}}
    <div>

        <div class="mb-6">
            <h2 class="text-3xl font-black">
                Role-Based Skill Gaps
            </h2>

            <p class="text-gray-600 mt-2">
                Missing technologies required to level up for specific roles.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @foreach($roleSkillGaps as $gap)

                <div class="bg-red-50 border-4 border-black shadow-[8px_8px_0px_#000] rounded-2xl p-6">

                    <div class="flex justify-between items-center mb-6">

                        <h3 class="text-2xl font-black">
                            {{ $gap['role'] }}
                        </h3>

                        <span class="px-4 py-2 bg-black text-white rounded-xl font-bold">
                            {{ $gap['match'] }}%
                        </span>

                    </div>

                    <div class="flex flex-wrap gap-3">

                        @foreach($gap['missing'] as $skill)

                            <span class="px-4 py-2 rounded-xl bg-white border-2 border-black font-semibold">
                                {{ $skill }}
                            </span>

                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

    </div>


    {{-- IMPACT SECTION --}}
    <div class="bg-black text-white border-4 border-black shadow-[8px_8px_0px_#000] rounded-2xl p-8">

        <h2 class="text-3xl font-black mb-6">
            High Impact Signals Detected
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white/10 p-6 rounded-2xl border border-white/20">
                <p class="text-5xl font-black">
                    57%
                </p>

                <p class="mt-2 text-sm uppercase tracking-widest">
                    User Growth Improvement
                </p>
            </div>

            <div class="bg-white/10 p-6 rounded-2xl border border-white/20">
                <p class="text-5xl font-black">
                    30%
                </p>

                <p class="mt-2 text-sm uppercase tracking-widest">
                    Performance Optimization
                </p>
            </div>

            <div class="bg-white/10 p-6 rounded-2xl border border-white/20">
                <p class="text-5xl font-black">
                    5000+
                </p>

                <p class="mt-2 text-sm uppercase tracking-widest">
                    Users Supported
                </p>
            </div>

        </div>

    </div>


    {{-- FINAL AI RECOMMENDATIONS --}}
    <div class="bg-gradient-to-br from-purple-200 to-pink-200 border-4 border-black shadow-[8px_8px_0px_#000] rounded-2xl p-8">

        <h2 class="text-3xl font-black mb-6">
            AI Recommendations
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white border-2 border-black rounded-2xl p-6">

                <h3 class="font-black text-xl mb-4">
                    Immediate Improvements
                </h3>

                <ul class="space-y-3 font-medium">
                    <li>✔ Add Kubernetes project experience</li>
                    <li>✔ Add Redis caching implementation</li>
                    <li>✔ Add testing frameworks to projects</li>
                    <li>✔ Add system design exposure</li>
                </ul>

            </div>

            <div class="bg-white border-2 border-black rounded-2xl p-6">

                <h3 class="font-black text-xl mb-4">
                    High Potential Career Tracks
                </h3>

                <ul class="space-y-3 font-medium">
                    <li>🚀 Full Stack Engineer</li>
                    <li>🚀 Backend Engineer</li>
                    <li>🚀 DevOps Engineer</li>
                    <li>🚀 Cloud-Native Developer</li>
                </ul>

            </div>

        </div>

    </div>

</div>

</x-app-layout>