<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SentenceController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/sentences/practice', [SentenceController::class, 'create'])->name('sentences.create');
    Route::get('/sentences/history', [SentenceController::class, 'history'])->name('sentences.history');
    Route::post('/sentences', [SentenceController::class, 'store'])->name('sentences.store');

    Route::get('/words', [WordController::class, 'index'])->name('words.index');
    Route::get('/words/random', [WordController::class, 'random'])->name('words.random');
    Route::get('/words/today', [WordController::class, 'today'])->name('words.today');
    Route::get('/words/create', [WordController::class, 'create'])->name('words.create');
    Route::post('/words', [WordController::class, 'store'])->name('words.store');
});

require __DIR__.'/auth.php';
