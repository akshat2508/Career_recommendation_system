<x-app-layout>
<div class="max-w-3xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">Build Your Career Profile</h1>

    <form action="{{ route('career.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- CGPA -->
        <div>
            <label class="block font-semibold">CGPA</label>
            <input type="number" step="0.1" name="cgpa"
                class="w-full border rounded-lg p-3 mt-2"
                placeholder="Enter your CGPA">
        </div>

        <!-- Branch -->
        <div>
            <label class="block font-semibold">Branch</label>
            <input type="text" name="branch"
                class="w-full border rounded-lg p-3 mt-2"
                placeholder="e.g. CSE, IT">
        </div>

        <!-- Skills -->
        <div>
            <label class="block font-semibold">Skills (comma separated)</label>
            <input type="text" name="skills"
                class="w-full border rounded-lg p-3 mt-2"
                placeholder="e.g. Java, Python, React">
        </div>

        <!-- Interests -->
        <div>
            <label class="block font-semibold">Interests</label>
            <input type="text" name="interests"
                class="w-full border rounded-lg p-3 mt-2"
                placeholder="e.g. AI, Web Dev, Data Science">
        </div>

        <!-- Submit -->
        <button type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
            Generate Career Path 🚀
        </button>

    </form>

</div>
</x-app-layout>