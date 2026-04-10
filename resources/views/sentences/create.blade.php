<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Practice Sentences
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Success message --}}
            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Word Card --}}
            <div class="bg-indigo-600 text-white rounded-xl shadow-lg p-8 text-center">
                <p class="text-sm uppercase tracking-widest text-indigo-200 mb-2">Your Word</p>
                <h1 class="text-4xl font-bold mb-2">{{ $word->english_word }}</h1>
                <p class="text-indigo-200 text-lg">{{ $word->bangla_meaning }}</p>
                @if ($word->example_sentence)
                    <p class="mt-4 text-sm text-indigo-100 italic">"{{ $word->example_sentence }}"</p>
                @endif
                <a href="{{ route('sentences.create') }}"
                   class="mt-5 inline-block bg-white text-indigo-600 text-sm font-semibold py-2 px-5 rounded-full hover:bg-indigo-50 transition">
                    Try Another Word
                </a>
            </div>

            {{-- Sentence Form --}}
            <div class="bg-white shadow-sm rounded-xl p-6">
                <form method="POST" action="{{ route('sentences.store') }}">
                    @csrf
                    <input type="hidden" name="word_id" value="{{ $word->id }}">

                    {{-- Word picker --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Or pick a different word
                        </label>
                        <select
                            name="word_id"
                            onchange="this.form.action='{{ route('sentences.create') }}?word_id='+this.value; this.form.method='GET'; this.form.submit();"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                        >
                            @foreach ($words as $w)
                                <option value="{{ $w->id }}" {{ $w->id === $word->id ? 'selected' : '' }}>
                                    {{ $w->english_word }} — {{ $w->bangla_meaning }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="border-t border-gray-100 my-4"></div>

                    {{-- Sentence input --}}
                    <input type="hidden" name="word_id" value="{{ $word->id }}">
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Write your sentence using <span class="text-indigo-600 font-semibold">{{ $word->english_word }}</span>
                        </label>
                        <textarea
                            name="user_sentence"
                            rows="4"
                            placeholder="Write a sentence with '{{ $word->english_word }}'..."
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >{{ old('user_sentence') }}</textarea>
                        @error('user_sentence')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-sm font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 cursor-pointer"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Sentence
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
