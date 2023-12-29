<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleChoiceQuestion extends Question
{
    use HasFactory;

    public function evaluate(string $answer): int
    {
        return 123;
    }
}
