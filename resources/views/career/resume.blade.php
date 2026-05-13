<x-app-layout>

<div class="space-y-14 pb-14">

    {{-- HERO SECTION --}}
    <section class="grid grid-cols-1 xl:grid-cols-2 gap-12 items-center min-h-[75vh]">

        {{-- LEFT CONTENT --}}
        <div class="max-w-2xl">

            <div class="inline-flex items-center gap-3 px-5 py-3 rounded-full border-2 border-black bg-yellow-100 shadow-[4px_4px_0px_#000] mb-8">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>

                <p class="font-bold text-sm tracking-[0.15em] uppercase">
                    AI Resume Intelligence Platform
                </p>

            </div>

            <h1 class="text-5xl md:text-6xl xl:text-7xl leading-[1.05] font-black tracking-tight text-black">

                Transform Your Resume Into
                <span class="relative inline-block mt-3">
                    <span class="bg-black text-white px-5 py-2 inline-block rotate-[-1deg]">
                        Career Intelligence
                    </span>
                </span>

            </h1>

            <p class="mt-8 text-lg md:text-xl leading-relaxed text-gray-700 max-w-xl">

                Get ATS analysis, skill intelligence, career matching,
                and personalized engineering recommendations powered by AI.

            </p>


            {{-- FEATURE GRID --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-12">

                <div class="bg-white border-3 border-black rounded-3xl p-6 shadow-[6px_6px_0px_#000]">

                    <div class="w-14 h-14 rounded-2xl bg-green-100 border-2 border-black flex items-center justify-center mb-5">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6m4 6V7m4 10v-3M5 21h14" />
                        </svg>

                    </div>

                    <h3 class="font-black text-xl">
                        ATS Optimization
                    </h3>

                    <p class="text-gray-600 mt-3 leading-relaxed text-sm">
                        Evaluate recruiter compatibility and resume quality.
                    </p>

                </div>

                <div class="bg-white border-3 border-black rounded-3xl p-6 shadow-[6px_6px_0px_#000]">

                    <div class="w-14 h-14 rounded-2xl bg-blue-100 border-2 border-black flex items-center justify-center mb-5">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3a.75.75 0 00-.75.75v16.5a.75.75 0 001.28.53l5.5-5.5a.75.75 0 000-1.06l-5.5-5.5A.75.75 0 009 9.75V3.75A.75.75 0 008.25 3h1.5z" />
                        </svg>

                    </div>

                    <h3 class="font-black text-xl">
                        Skill Intelligence
                    </h3>

                    <p class="text-gray-600 mt-3 leading-relaxed text-sm">
                        Detect technologies, strengths, and role readiness.
                    </p>

                </div>

                <div class="bg-white border-3 border-black rounded-3xl p-6 shadow-[6px_6px_0px_#000]">

                    <div class="w-14 h-14 rounded-2xl bg-pink-100 border-2 border-black flex items-center justify-center mb-5">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5V4H2v16h5m10 0v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6m10 0H7" />
                        </svg>

                    </div>

                    <h3 class="font-black text-xl">
                        Career Matching
                    </h3>

                    <p class="text-gray-600 mt-3 leading-relaxed text-sm">
                        Discover the engineering roles best suited for you.
                    </p>

                </div>

                <div class="bg-white border-3 border-black rounded-3xl p-6 shadow-[6px_6px_0px_#000]">

                    <div class="w-14 h-14 rounded-2xl bg-yellow-100 border-2 border-black flex items-center justify-center mb-5">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </div>

                    <h3 class="font-black text-xl">
                        AI Insights
                    </h3>

                    <p class="text-gray-600 mt-3 leading-relaxed text-sm">
                        Receive actionable improvements and guidance.
                    </p>

                </div>

            </div>

        </div>


        {{-- RIGHT PANEL --}}
        <div class="relative flex justify-center xl:justify-end">

            <div class="absolute top-10 right-6 w-52 h-52 bg-yellow-200 rounded-full border-4 border-black"></div>
            <div class="absolute bottom-10 left-4 w-40 h-40 bg-blue-200 rounded-full border-4 border-black"></div>

            <div class="relative z-10 w-full max-w-xl bg-white border-4 border-black rounded-[2rem] p-8 shadow-[12px_12px_0px_#000]">

                <div class="flex items-start justify-between mb-10">

                    <div>
                        <p class="uppercase tracking-[0.2em] text-xs font-bold text-gray-500">
                            Resume Upload
                        </p>

                        <h2 class="text-4xl font-black mt-3 leading-tight">
                            Analyze Your Resume
                        </h2>
                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-black text-white flex items-center justify-center border-2 border-black">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-3.414-3.414A2 2 0 0013.586 2H7a2 2 0 00-2 2v15a2 2 0 002 2z" />
                        </svg>

                    </div>

                </div>


                {{-- FORM --}}
                <form
                    action="{{ route('resume.analyze') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-6"
                >

                    @csrf

                    <label class="block">

                        <div class="border-[3px] border-dashed border-black rounded-3xl bg-gray-50 p-12 text-center hover:bg-gray-100 transition-all duration-200 cursor-pointer">

                            <div class="w-24 h-24 rounded-full bg-black text-white flex items-center justify-center mx-auto mb-6 border-4 border-black">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 0115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>

                            </div>

                            <h3 class="text-2xl font-black">
                                Upload Resume
                            </h3>

                            <p class="mt-3 text-gray-600 leading-relaxed">
                                Drag & drop your resume or click to browse.
                            </p>

                            <div class="flex justify-center gap-3 mt-5">
                                <span class="px-4 py-2 rounded-full border-2 border-black bg-white text-sm font-bold">
                                    PDF
                                </span>

                                <span class="px-4 py-2 rounded-full border-2 border-black bg-white text-sm font-bold">
                                    DOCX
                                </span>
                            </div>

                            <input
                                type="file"
                                name="resume"
                                required
                                accept=".pdf,.docx"
                                class="hidden"
                            >

                        </div>

                    </label>

                    <button class="w-full bg-black text-white border-4 border-black rounded-2xl py-5 text-xl font-black hover:bg-white hover:text-black transition-all duration-200 shadow-[6px_6px_0px_#000] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[3px_3px_0px_#000]">

                        Analyze Resume

                    </button>

                </form>


                {{-- STATS --}}
                <div class="grid grid-cols-3 gap-4 mt-8">

                    <div class="bg-green-100 border-2 border-black rounded-2xl p-4 text-center">
                        <p class="text-3xl font-black">95%</p>
                        <p class="text-xs uppercase font-bold tracking-wide mt-1">
                            ATS Accuracy
                        </p>
                    </div>

                    <div class="bg-blue-100 border-2 border-black rounded-2xl p-4 text-center">
                        <p class="text-3xl font-black">AI</p>
                        <p class="text-xs uppercase font-bold tracking-wide mt-1">
                            Powered
                        </p>
                    </div>

                    <div class="bg-pink-100 border-2 border-black rounded-2xl p-4 text-center">
                        <p class="text-3xl font-black">10+</p>
                        <p class="text-xs uppercase font-bold tracking-wide mt-1">
                            Career Paths
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- HOW IT WORKS --}}
    <section class="bg-white border-4 border-black rounded-[2rem] p-10 md:p-14 shadow-[10px_10px_0px_#000]">

        <div class="text-center max-w-3xl mx-auto mb-14">

            <p class="uppercase tracking-[0.25em] text-sm font-bold text-gray-500">
                PROCESS
            </p>

            <h2 class="text-4xl md:text-5xl font-black mt-5 leading-tight">
                Resume Analysis Pipeline
            </h2>

            <p class="text-gray-600 mt-5 text-lg leading-relaxed">
                Our AI pipeline extracts technical skills, evaluates ATS compatibility,
                detects role alignment, and generates actionable insights.
            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">

            <div class="rounded-3xl border-3 border-black p-8 bg-yellow-100 shadow-[6px_6px_0px_#000]">

                <div class="w-16 h-16 rounded-2xl bg-black text-white flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-3.414-3.414A2 2 0 0013.586 2H7a2 2 0 00-2 2v15a2 2 0 002 2z" />
                    </svg>
                </div>

                <h3 class="text-2xl font-black">
                    Upload
                </h3>

                <p class="mt-4 text-gray-700 leading-relaxed">
                    Upload your resume in PDF or DOCX format.
                </p>

            </div>

            <div class="rounded-3xl border-3 border-black p-8 bg-green-100 shadow-[6px_6px_0px_#000]">

                <div class="w-16 h-16 rounded-2xl bg-black text-white flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12l-5.25-5" />
                    </svg>
                </div>

                <h3 class="text-2xl font-black">
                    Extract
                </h3>

                <p class="mt-4 text-gray-700 leading-relaxed">
                    AI extracts technologies, projects, and experience.
                </p>

            </div>

            <div class="rounded-3xl border-3 border-black p-8 bg-blue-100 shadow-[6px_6px_0px_#000]">

                <div class="w-16 h-16 rounded-2xl bg-black text-white flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 11V7m0 4H7m4 0h4m-4 0v4" />
                    </svg>
                </div>

                <h3 class="text-2xl font-black">
                    Analyze
                </h3>

                <p class="mt-4 text-gray-700 leading-relaxed">
                    Evaluate ATS quality and role compatibility.
                </p>

            </div>

            <div class="rounded-3xl border-3 border-black p-8 bg-pink-100 shadow-[6px_6px_0px_#000]">

                <div class="w-16 h-16 rounded-2xl bg-black text-white flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>

                <h3 class="text-2xl font-black">
                    Improve
                </h3>

                <p class="mt-4 text-gray-700 leading-relaxed">
                    Get actionable engineering and career insights.
                </p>

            </div>

        </div>

    </section>

</div>

</x-app-layout>