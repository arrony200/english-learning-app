<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Random Practice</h2>
    </x-slot>

    <div class="max-w-xl mx-auto space-y-5">

        @if (session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Progress bar --}}
        @php $progress = $total > 0 ? round((count($seen) / $total) * 100) : 0; @endphp
        <div>
            <div class="flex justify-between text-xs text-gray-500 mb-1">
                <span>{{ count($seen) }} / {{ $total }} words seen</span>
                <span>{{ $progress }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-indigo-500 h-2 rounded-full transition-all duration-500"
                     style="width: {{ $progress }}%"></div>
            </div>
        </div>

        @if (! $word)

            {{-- All done --}}
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <div class="text-5xl mb-4">🎉</div>
                <h3 class="text-xl font-bold text-gray-800 mb-1">You've practiced all words!</h3>
                <p class="text-gray-500 text-sm mb-6">Great job! Start over to keep building your memory.</p>
                <a href="{{ route('words.random') }}"
                   class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2.5 px-6 rounded-lg shadow transition">
                    Start Over
                </a>
            </div>

        @else

            {{-- Flashcard --}}
            <div x-data="{ revealed: false }">

                {{-- Front --}}
                <div x-show="!revealed"
                     class="bg-indigo-600 text-white rounded-2xl shadow-lg p-10 text-center min-h-52 flex flex-col items-center justify-center gap-3">
                    <p class="text-xs uppercase tracking-widest text-indigo-300">What does this word mean?</p>
                    <h2 class="text-5xl font-bold">{{ $word->english_word }}</h2>
                    <button @click="revealed = true"
                            class="mt-4 bg-white text-indigo-600 hover:bg-indigo-50 text-sm font-semibold py-2 px-6 rounded-full shadow transition">
                        Reveal Meaning
                    </button>
                </div>

                {{-- Back --}}
                <div x-show="revealed" x-transition
                     class="bg-white border-2 border-indigo-200 rounded-2xl shadow-lg p-10 text-center min-h-52 flex flex-col items-center justify-center gap-3">
                    <p class="text-xs uppercase tracking-widest text-indigo-400">Meaning</p>
                    <h2 class="text-4xl font-bold text-indigo-700">{{ $word->bangla_meaning }}</h2>
                    @if ($word->example_sentence)
                        <p class="text-gray-500 text-sm italic mt-1">"{{ $word->example_sentence }}"</p>
                    @endif
                    <button @click="revealed = false"
                            class="mt-3 text-xs text-indigo-400 hover:text-indigo-600 underline transition">
                        Hide
                    </button>
                </div>

            </div>

            {{-- Write a sentence --}}
            <div class="bg-white rounded-xl shadow-sm p-5">
                <form method="POST" action="{{ route('sentences.store') }}">
                    @csrf
                    <input type="hidden" name="word_id" value="{{ $word->id }}">
                    <input type="hidden" name="redirect_to" value="{{ route('words.random', ['exclude' => implode(',', $seen)]) }}">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Write a sentence using
                        <span class="text-indigo-600 font-semibold">{{ $word->english_word }}</span>
                        <span class="text-gray-400 font-normal">(optional)</span>
                    </label>
                    <textarea
                        name="user_sentence"
                        rows="3"
                        placeholder="Use '{{ $word->english_word }}' in a sentence..."
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                    >{{ old('user_sentence') }}</textarea>
                    @error('user_sentence')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <button type="submit"
                            class="mt-3 w-full inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2.5 px-4 rounded-lg shadow transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Save & Next Word
                    </button>
                </form>
            </div>

            {{-- Skip button --}}
            <a href="{{ route('words.random', ['exclude' => implode(',', $seen)]) }}"
               class="flex items-center justify-center gap-2 w-full bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 hover:text-gray-800 text-sm font-semibold py-3 rounded-xl shadow-sm transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
                Skip — Next Word
            </a>

        @endif

    </div>
</x-app-layout>
