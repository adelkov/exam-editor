<?php

namespace App\Filament\Resources\SingleChoiceQuestionResource\Pages;

use App\Filament\Resources\SingleChoiceQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSingleChoiceQuestions extends ListRecords
{
    protected static string $resource = SingleChoiceQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
