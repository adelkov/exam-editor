<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeNumericQuestion extends Question
{
    use HasFactory;

    public function evaluate(string $answer): int
    {
        // TODO: Implement evaluate() method.

        return 12;
    }
}
