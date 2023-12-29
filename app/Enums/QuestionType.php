<?php

namespace App\Enums;

enum QuestionType: string
{
    case MultipleChoice = 'multiple-choice';
    case  SingleChoice = 'single-choice';
    case TrueOrFalse = 'true-or-false';
    case PerDigitMatch = 'per-digit-match';
    case AllAnswersAreGood = 'all-answers-are-good';
    case FreeNumeric = 'free-numeric';
    case ClockMatch = 'clock-match';
    case PartialImageMatch = 'partial-image-match';
}
