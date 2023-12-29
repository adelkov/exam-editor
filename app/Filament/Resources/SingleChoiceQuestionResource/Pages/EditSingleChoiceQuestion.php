<?php

namespace App\Filament\Resources\SingleChoiceQuestionResource\Pages;

use App\Filament\Resources\SingleChoiceQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSingleChoiceQuestion extends EditRecord
{
    protected static string $resource = SingleChoiceQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
