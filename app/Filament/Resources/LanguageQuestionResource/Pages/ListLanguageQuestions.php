<?php

namespace App\Filament\Resources\LanguageQuestionResource\Pages;

use App\Filament\Resources\LanguageQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLanguageQuestions extends ListRecords
{
    protected static string $resource = LanguageQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
