<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sentence History
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-4">

        @if ($sentences->isEmpty())
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <div class="text-5xl mb-4">📝</div>
                <p class="text-gray-500 text-lg">You haven't written any sentences yet.</p>
                <a href="{{ route('sentences.create') }}" class="mt-4 inline-block text-indigo-600 hover:underline font-medium">
                    Start practicing
                </a>
            </div>
        @else
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm text-gray-500">{{ $sentences->total() }} {{ Str::plural('sentence', $sentences->total()) }} written</p>
                <a href="{{ route('sentences.create') }}"
                   class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2 px-4 rounded-lg shadow transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    New Sentence
                </a>
            </div>

            @foreach ($sentences as $sentence)
                <div class="bg-white rounded-xl shadow-sm p-5 flex gap-4">

                    {{-- Word badge --}}
                    <div class="shrink-0">
                        <div class="bg-indigo-100 text-indigo-700 rounded-lg px-3 py-2 text-center min-w-[90px]">
                            <p class="text-sm font-bold leading-tight">{{ $sentence->word->english_word }}</p>
                            <p class="text-xs text-indigo-500 mt-0.5">{{ $sentence->word->bangla_meaning }}</p>
                        </div>
                    </div>

                    {{-- Sentence + meta --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-gray-800 leading-relaxed">"{{ $sentence->user_sentence }}"</p>
                        <p class="text-xs text-gray-400 mt-2">{{ $sentence->created_at->format('d M Y, h:i A') }}</p>
                    </div>

                </div>
            @endforeach

            @if ($sentences->hasPages())
                <div class="pt-2">
                    {{ $sentences->links() }}
                </div>
            @endif
        @endif

    </div>
</x-app-layout>
