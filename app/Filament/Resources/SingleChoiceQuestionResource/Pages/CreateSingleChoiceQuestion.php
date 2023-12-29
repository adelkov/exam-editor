<?php

namespace App\Filament\Resources\SingleChoiceQuestionResource\Pages;

use App\Filament\Resources\SingleChoiceQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSingleChoiceQuestion extends CreateRecord
{
    protected static string $resource = SingleChoiceQuestionResource::class;
}
