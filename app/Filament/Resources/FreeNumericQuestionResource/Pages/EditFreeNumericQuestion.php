<?php

namespace App\Filament\Resources\FreeNumericQuestionResource\Pages;

use App\Filament\Resources\FreeNumericQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFreeNumericQuestion extends EditRecord
{
    protected static string $resource = FreeNumericQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
