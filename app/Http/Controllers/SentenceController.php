<?php

namespace App\Http\Controllers;

use App\Models\Sentence;
use App\Models\Word;
use Illuminate\Http\Request;

class SentenceController extends Controller
{
    public function create(Request $request)
    {
        $word = $request->word_id
            ? Word::findOrFail($request->word_id)
            : Word::inRandomOrder()->first();

        $words = Word::orderBy('english_word')->get();

        return view('sentences.create', compact('word', 'words'));
    }

    public function history()
    {
        $sentences = Sentence::with('word')->latest()->paginate(10);

        return view('sentences.history', compact('sentences'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'word_id'       => 'required|exists:words,id',
            'user_sentence' => 'required|string',
        ]);

        Sentence::create($request->only('word_id', 'user_sentence'));

        return back()->with('success', 'Sentence saved successfully!');
    }
}
