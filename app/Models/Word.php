<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['english_word', 'bangla_meaning', 'example_sentence'];

    public function sentences()
    {
        return $this->hasMany(Sentence::class);
    }
}
