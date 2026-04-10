<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function index()
    {
        $words = Word::latest()->paginate(10);

        return view('words.index', compact('words'));
    }

    public function today()
    {
        $words = Word::whereDate('created_at', today())->latest()->get();

        return view('words.today', compact('words'));
    }

    public function create()
    {
        return view('words.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'english_word'     => 'required|string|max:255',
            'bangla_meaning'   => 'required|string|max:255',
            'example_sentence' => 'nullable|string',
        ]);

        Word::create($request->only('english_word', 'bangla_meaning', 'example_sentence'));

        return redirect()->route('words.index')->with('success', 'Word added successfully!');
    }
}
