<?php

namespace App\Filament\Resources\ContentItemResource\Pages;

use App\Filament\Resources\ContentItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContentItem extends CreateRecord
{
    protected static string $resource = ContentItemResource::class;

     protected function getHeaderActions(): array
    {
        return [
            \App\Filament\Actions\GenerateMagicContentAction::make(),
        ];
    }
}
