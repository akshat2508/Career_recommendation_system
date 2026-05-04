@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            🚀 AI Career Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto space-y-10">

            <!-- 🔥 Latest Recommendation -->
            <div>
                <h2 class="text-xl font-semibold text-indigo-600 mb-4">
                    🔥 Latest Recommendation
                </h2>

                @if($latest)
                    <div class="bg-white shadow-lg rounded-xl p-6 border">
                        <div class="whitespace-pre-line text-gray-700">
                            {{ $latest->description }}
                        </div>
                    </div>
                @endif
            </div>

            <!-- 📜 History -->
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4">
                    📜 Previous Recommendations
                </h2>

                <div class="grid gap-4">
                    @foreach($history as $rec)
                        <div class="bg-gray-50 border rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <div class="text-sm text-gray-500 mb-2">
                                {{ $rec->created_at->format('d M Y, h:i A') }}
                            </div>

                            <div class="whitespace-pre-line text-gray-700 text-sm">
                                {{ Str::limit($rec->description, 300) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- ➕ Button -->
            <div class="text-center">
                <a href="{{ route('career.create') }}"
                   class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
                    ➕ Generate New Recommendation
                </a>
            </div>

        </div>
    </div>
</x-app-layout>