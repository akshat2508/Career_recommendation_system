<x-app-layout>

<div class="space-y-6">

    <div class="bg-green-200 brutal-sm p-6">

        <h1 class="text-4xl font-bold">
            ATS Score:
{{ $analysis['ats_score'] ?? 0 }} / 100
        </h1>

    </div>

    <div class="bg-white brutal-sm p-6">

        <h2 class="text-2xl font-bold mb-4">
            Detected Skills
        </h2>

        <div class="flex flex-wrap gap-3">

            @foreach(($analysis['detected_skills'] ?? []) as $skill)
                <span class="px-3 py-1 bg-blue-200 rounded">
                    {{ $skill }}
                </span>

            @endforeach

        </div>
    </div>

    <div class="bg-white brutal-sm p-6">

        <h2 class="text-2xl font-bold mb-4">
            Career Matches
        </h2>

        <div class="space-y-4">

        @foreach(($analysis['career_matches'] ?? []) as $career)    

                <div class="border p-4 rounded">

                    <div class="flex justify-between">

                        <h3 class="font-bold text-xl">
                            {{ $career['role'] }}
                        </h3>

                        <span class="font-bold">
                            {{ $career['match_percentage'] }}%
                        </span>

                    </div>

                </div>

            @endforeach

        </div>
    </div>

    <div class="bg-red-100 brutal-sm p-6">

        <h2 class="text-2xl font-bold mb-4">
            Missing Skills
        </h2>

        <ul class="list-disc pl-6">

        @foreach(($analysis['missing_skills'] ?? []) as $skill)
            

                <li>{{ $skill }}</li>

            @endforeach

        </ul>

    </div>

</div>

</x-app-layout>