<x-app-layout>

<div 
    x-data="{ step: 1 }" 
    class="max-w-3xl mx-auto p-6 space-y-8"
>

    <!-- HEADER -->
    <div class="brutal p-6 bg-yellow-200">
        <h1 class="text-3xl font-bold">Career Onboarding</h1>
        <p class="text-sm mt-2">Let’s build your profile step-by-step</p>
    </div>

    <!-- PROGRESS BAR -->
    <div class="w-full">
        <div class="flex justify-between text-sm font-semibold mb-2">
            <span>Step <span x-text="step"></span> of 5</span>
            <span x-text="(step*20) + '%'"></span>
        </div>
        <div class="w-full h-3 bg-gray-200">
            <div 
                class="h-3 bg-black transition-all duration-300"
                :style="'width:' + (step*20) + '%'"
            ></div>
        </div>
    </div>

    <!-- FORM -->
    <form action="{{ route('career.store') }}" method="POST">
        @csrf

        <!-- STEP 1 -->
        <div x-show="step === 1" x-transition class="brutal p-6">
            <h2 class="text-xl font-bold mb-4">Academic Info</h2>

            <label class="font-semibold">CGPA</label>
            <input type="number" step="0.1" name="cgpa"
                class="w-full mt-2 p-2 brutal-sm"
                placeholder="e.g. 8.5">
        </div>

        <!-- STEP 2 -->
        <div x-show="step === 2" x-transition class="brutal p-6">
            <h2 class="text-xl font-bold mb-4">Background</h2>

            <label class="font-semibold">Branch</label>
            <input type="text" name="branch"
                class="w-full mt-2 p-2 brutal-sm"
                placeholder="CSE, IT">
        </div>

        <!-- STEP 3 -->
        <div x-show="step === 3" x-transition class="brutal p-6">
            <h2 class="text-xl font-bold mb-4">Skills</h2>

            <label class="font-semibold">Your Skills</label>
            <input type="text" name="skills"
                class="w-full mt-2 p-2 brutal-sm"
                placeholder="Java, Python, React">
        </div>

        <!-- STEP 4 -->
        <div x-show="step === 4" x-transition class="brutal p-6">
            <h2 class="text-xl font-bold mb-4">Interests</h2>

            <label class="font-semibold">What excites you?</label>
            <input type="text" name="interests"
                class="w-full mt-2 p-2 brutal-sm"
                placeholder="AI, Web Dev">
        </div>

        <!-- STEP 5 REVIEW -->
        <div x-show="step === 5" x-transition class="brutal p-6">
            <h2 class="text-xl font-bold mb-4">Review & Submit</h2>

            <p class="text-sm">
                Click below to generate your AI-powered career path 🚀
            </p>
        </div>

        <!-- NAV BUTTONS -->
        <div class="flex justify-between mt-6">

            <!-- BACK -->
            <button 
                type="button"
                x-show="step > 1"
                @click="step--"
                class="brutal-btn px-4 py-2 bg-gray-200 font-semibold"
            >
                ← Back
            </button>

            <!-- NEXT -->
            <button 
                type="button"
                x-show="step < 5"
                @click="step++"
                class="ml-auto brutal-btn px-4 py-2 bg-blue-300 font-semibold"
            >
                Next →
            </button>

            <!-- SUBMIT -->
            <button 
                type="submit"
                x-show="step === 5"
                class="ml-auto brutal-btn px-6 py-2 bg-green-300 font-bold"
            >
                Generate Career 🚀
            </button>

        </div>

    </form>

</div>

</x-app-layout>