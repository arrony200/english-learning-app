<?php

namespace Database\Seeders;

use App\Models\Word;
use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    public function run(): void
    {
        $words = [
            ['english_word' => 'Ambitious',    'bangla_meaning' => 'উচ্চাভিলাষী',  'example_sentence' => 'She is an ambitious student who works very hard.'],
            ['english_word' => 'Eloquent',     'bangla_meaning' => 'বাকপটু',        'example_sentence' => 'He gave an eloquent speech at the ceremony.'],
            ['english_word' => 'Perseverance', 'bangla_meaning' => 'অধ্যবসায়',     'example_sentence' => 'Perseverance is the key to success.'],
            ['english_word' => 'Generous',     'bangla_meaning' => 'উদার',          'example_sentence' => 'He is very generous with his time and money.'],
            ['english_word' => 'Diligent',     'bangla_meaning' => 'পরিশ্রমী',     'example_sentence' => 'A diligent worker always meets deadlines.'],
            ['english_word' => 'Courage',      'bangla_meaning' => 'সাহস',          'example_sentence' => 'It takes courage to speak the truth.'],
            ['english_word' => 'Humble',       'bangla_meaning' => 'বিনয়ী',        'example_sentence' => 'Despite his success, he remained humble.'],
            ['english_word' => 'Gratitude',    'bangla_meaning' => 'কৃতজ্ঞতা',    'example_sentence' => 'Express gratitude to those who help you.'],
        ];

        foreach ($words as $word) {
            Word::create($word);
        }
    }
}
