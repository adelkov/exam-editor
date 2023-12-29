<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleChoiceQuestion extends Question
{
    use HasFactory;

    public function question()
    {
        return $this->morphOne(Question::class, 'questionable');
    }

    public function evaluate(string $answer): int
    {
        return 123;
    }
}
