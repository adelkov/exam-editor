<?php

namespace App\Filament\Resources\ExamTemplateResource\Pages;

use App\Filament\Resources\ExamTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExamTemplates extends ListRecords
{
    protected static string $resource = ExamTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
