<?php

namespace App\Filament\Resources\LanguageLessonResource\Pages;

use App\Filament\Resources\LanguageLessonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLanguageLesson extends EditRecord
{
    protected static string $resource = LanguageLessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
