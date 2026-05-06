<x-app-layout>
<div x-data="{
    step: 1,
    total: 4,
    answers: {},

    nextStep() {
        if (
            (this.step === 1 && !this.answers.analytical) ||
            (this.step === 2 && !this.answers.creative) ||
            (this.step === 3 && !this.answers.social) ||
            (this.step === 4 && !this.answers.structured)
        ) {
            alert('Please select an option first');
            return;
        }
        this.step++;
    }
}" class="max-w-3xl mx-auto p-6 space-y-8">

    <!-- HEADER -->
    <div class="brutal p-6 bg-yellow-200">
        <h1 class="text-3xl font-bold">Personality Assessment</h1>
        <p class="text-sm mt-2">Answer a few quick questions to improve your recommendations</p>
    </div>

    <!-- PROGRESS -->
    <div>
        <div class="flex justify-between text-sm font-semibold mb-2">
            <span>Step <span x-text="step"></span> / <span x-text="total"></span></span>
            <span x-text="Math.round((step/total)*100) + '%'"></span>
        </div>
        <div class="w-full h-3 bg-gray-200">
            <div class="h-3 bg-black transition-all duration-300"
                 :style="'width:' + (step/total)*100 + '%'"></div>
        </div>
    </div>

    <form method="POST" action="{{ route('personality.submit') }}">
        @csrf

        <!-- STEP 1 -->
        <div x-show="step === 1" x-transition class="brutal p-6">
            <h2 class="text-xl font-bold mb-4">I enjoy solving complex problems</h2>

            <div class="grid grid-cols-2 gap-3">
                @foreach([1,2,3,4,5] as $val)
                <label 
                    @click="answers.analytical = {{ $val }}"
                    :class="answers.analytical === {{ $val }} ? 'bg-black text-white' : 'bg-white'"
                    class="brutal-sm p-3 cursor-pointer text-center transition">

                    <input type="radio" name="answers[analytical]" value="{{ $val }}" class="hidden">

                    {{ ['Strongly Disagree','Disagree','Neutral','Agree','Strongly Agree'][$val-1] }}
                </label>
                @endforeach
            </div>
        </div>

        <!-- STEP 2 -->
        <div x-show="step === 2" x-transition class="brutal p-6">
            <h2 class="text-xl font-bold mb-4">I like being creative and designing things</h2>

            <div class="grid grid-cols-2 gap-3">
                @foreach([1,2,3,4,5] as $val)
                <label 
                    @click="answers.creative = {{ $val }}"
                    :class="answers.creative === {{ $val }} ? 'bg-black text-white' : 'bg-white'"
                    class="brutal-sm p-3 cursor-pointer text-center transition">

                    <input type="radio" name="answers[creative]" value="{{ $val }}" class="hidden">

                    {{ ['Strongly Disagree','Disagree','Neutral','Agree','Strongly Agree'][$val-1] }}
                </label>
                @endforeach
            </div>
        </div>

        <!-- STEP 3 -->
        <div x-show="step === 3" x-transition class="brutal p-6">
            <h2 class="text-xl font-bold mb-4">I enjoy working with people</h2>

            <div class="grid grid-cols-2 gap-3">
                @foreach([1,2,3,4,5] as $val)
                <label 
                    @click="answers.social = {{ $val }}"
                    :class="answers.social === {{ $val }} ? 'bg-black text-white' : 'bg-white'"
                    class="brutal-sm p-3 cursor-pointer text-center transition">

                    <input type="radio" name="answers[social]" value="{{ $val }}" class="hidden">

                    {{ ['Strongly Disagree','Disagree','Neutral','Agree','Strongly Agree'][$val-1] }}
                </label>
                @endforeach
            </div>
        </div>

        <!-- STEP 4 -->
        <div x-show="step === 4" x-transition class="brutal p-6">
            <h2 class="text-xl font-bold mb-4">I prefer structured and organized tasks</h2>

            <div class="grid grid-cols-2 gap-3">
                @foreach([1,2,3,4,5] as $val)
                <label 
                    @click="answers.structured = {{ $val }}"
                    :class="answers.structured === {{ $val }} ? 'bg-black text-white' : 'bg-white'"
                    class="brutal-sm p-3 cursor-pointer text-center transition">

                    <input type="radio" name="answers[structured]" value="{{ $val }}" class="hidden">

                    {{ ['Strongly Disagree','Disagree','Neutral','Agree','Strongly Agree'][$val-1] }}
                </label>
                @endforeach
            </div>
        </div>

        <!-- NAV -->
        <div class="flex justify-between mt-6">

            <!-- BACK -->
            <button type="button"
                x-show="step > 1"
                @click="step--"
                class="brutal-btn px-4 py-2 bg-gray-200 font-semibold">
                ← Back
            </button>

            <!-- NEXT -->
            <button 
    type="button"
    x-show="step < total"
    @click="nextStep()"
    class="ml-auto brutal-btn px-4 py-2 bg-blue-300 font-semibold">
    Next →
</button>

            <!-- SUBMIT -->
            <button type="submit"
                x-show="step === total"
                class="ml-auto brutal-btn px-6 py-2 bg-green-300 font-bold">
                Finish →
            </button>

        </div>

    </form>

</div>

</x-app-layout>