<x-app-layout>
<div class="max-w-3xl mx-auto p-6">

<h2 class="text-2xl font-bold mb-6">Personality Assessment</h2>

<form method="POST" action="{{ route('personality.submit') }}">
@csrf

@php
$questions = [
    'I enjoy solving complex problems' => 'analytical',
    'I like being creative and designing things' => 'creative',
    'I enjoy working with people' => 'social',
    'I prefer structured and organized tasks' => 'structured',
];
@endphp

@foreach($questions as $q => $type)
<div class="mb-4">
    <label class="block font-medium mb-2">{{ $q }}</label>

<select name="answers[{{ $type }}]" class="w-full border p-2 rounded">
            <option value="1">Strongly Disagree</option>
        <option value="2">Disagree</option>
        <option value="3">Neutral</option>
        <option value="4">Agree</option>
        <option value="5">Strongly Agree</option>
    </select>
</div>
@endforeach

<button class="bg-blue-600 text-white px-4 py-2 rounded">
    Submit
</button>

</form>
</div>
</x-app-layout>