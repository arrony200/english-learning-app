<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    protected $fillable = ['word_id', 'user_sentence'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
