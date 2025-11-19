<?php

namespace App\Filament\Resources\LanguageModuleResource\Pages;

use App\Filament\Resources\LanguageModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLanguageModules extends ListRecords
{
    protected static string $resource = LanguageModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
