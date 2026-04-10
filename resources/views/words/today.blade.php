<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Today's Words
                </h2>
                <p class="text-sm text-gray-500 mt-1">{{ now()->format('l, F j, Y') }}</p>
            </div>
            <a href="{{ route('words.create') }}"
               class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2 px-4 rounded-lg shadow transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Add Word
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if ($words->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg p-12 text-center">
                    <div class="text-5xl mb-4">📖</div>
                    <p class="text-gray-500 text-lg">No words added today yet.</p>
                    <a href="{{ route('words.create') }}" class="mt-4 inline-block text-indigo-600 hover:underline font-medium">
                        Add your first word for today
                    </a>
                </div>
            @else
                <div class="mb-4 text-sm text-gray-500 font-medium">
                    {{ $words->count() }} {{ Str::plural('word', $words->count()) }} added today
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($words as $word)
                        <div class="bg-white shadow-sm sm:rounded-lg p-5 border-l-4 border-indigo-500">
                            <div class="flex items-start justify-between">
                                <h3 class="text-lg font-bold text-gray-800">{{ $word->english_word }}</h3>
                                <span class="text-xs text-gray-400">{{ $word->created_at->format('h:i A') }}</span>
                            </div>
                            <p class="text-indigo-600 font-medium mt-1">{{ $word->bangla_meaning }}</p>
                            @if ($word->example_sentence)
                                <p class="text-gray-500 text-sm italic mt-2">"{{ $word->example_sentence }}"</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
