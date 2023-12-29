<?php

namespace App\Contracts;

interface Evaluatable
{
    /**
     * Evaluate the user answer and return the achieved points.
     */
    public function evaluate(string $answer): int;
}
