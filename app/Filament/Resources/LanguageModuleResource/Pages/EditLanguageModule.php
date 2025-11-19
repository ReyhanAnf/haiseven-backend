<?php

namespace App\Filament\Resources\LanguageModuleResource\Pages;

use App\Filament\Resources\LanguageModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLanguageModule extends EditRecord
{
    protected static string $resource = LanguageModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
