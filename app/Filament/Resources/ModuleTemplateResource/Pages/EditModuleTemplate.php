<?php

namespace App\Filament\Resources\ModuleTemplateResource\Pages;

use App\Filament\Resources\ModuleTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModuleTemplate extends EditRecord
{
    protected static string $resource = ModuleTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
