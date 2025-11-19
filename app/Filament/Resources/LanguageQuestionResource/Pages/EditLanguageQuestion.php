<?php

namespace App\Filament\Resources\LanguageQuestionResource\Pages;

use App\Filament\Resources\LanguageQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLanguageQuestion extends EditRecord
{
    protected static string $resource = LanguageQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
