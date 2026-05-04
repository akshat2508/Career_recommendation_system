
<a href="{{ route('career.create') }}" 
   class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700">
    ➕ Generate New Recommendation
</a>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🚀 AI Career Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto space-y-6">

           <h2>🔥 Latest Recommendation</h2>

@if($latest)
<div class="card">
    {{ $latest->description }}
</div>
@endif

<h2>📜 Previous Results</h2>

@foreach($history as $rec)
    <div class="card">
        {{ $rec->description }}
    </div>
@endforeach
        </div>
    </div>
</x-app-layout>