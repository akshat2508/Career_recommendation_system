<x-app-layout>

<div class="bg-white brutal-sm p-8">

    <h1 class="text-3xl font-bold mb-6">
        Resume Analyzer
    </h1>

    <p class="mb-6 text-gray-700">
        Upload your resume to get:
    </p>

    <ul class="list-disc pl-6 mb-6">
        <li>ATS Score</li>
        <li>Skill Detection</li>
        <li>Career Recommendations</li>
        <li>Missing Skills</li>
        <li>Resume Improvements</li>
    </ul>

    <form action="{{ route('resume.analyze') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <input
            type="file"
            name="resume"
            required
            class="border p-3 w-full rounded"
        >

        <button
            class="brutal-btn mt-6 px-6 py-2 bg-blue-300"
        >
            Analyze Resume
        </button>

    </form>

</div>

</x-app-layout>