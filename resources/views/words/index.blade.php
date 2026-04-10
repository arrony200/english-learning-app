<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Word List
            </h2>
            <a href="{{ route('words.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2 px-4 rounded-md transition">
                + Add Word
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                @if ($words->isEmpty())
                    <div class="p-8 text-center text-gray-500">
                        No words added yet.
                        <a href="{{ route('words.create') }}" class="text-indigo-600 hover:underline">Add your first word</a>.
                    </div>
                @else
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3">#</th>
                                <th class="px-6 py-3">English Word</th>
                                <th class="px-6 py-3">Bangla Meaning</th>
                                <th class="px-6 py-3">Example Sentence</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($words as $word)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-400">{{ $loop->iteration + ($words->currentPage() - 1) * $words->perPage() }}</td>
                                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $word->english_word }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $word->bangla_meaning }}</td>
                                    <td class="px-6 py-4 text-gray-500 italic">{{ $word->example_sentence ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($words->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $words->links() }}
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
