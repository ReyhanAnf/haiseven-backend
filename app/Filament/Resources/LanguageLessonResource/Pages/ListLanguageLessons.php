<?php

namespace App\Filament\Resources\LanguageLessonResource\Pages;

use App\Filament\Resources\LanguageLessonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLanguageLessons extends ListRecords
{
    protected static string $resource = LanguageLessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
