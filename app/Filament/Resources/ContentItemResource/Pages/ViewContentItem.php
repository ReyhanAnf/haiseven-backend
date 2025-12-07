<?php

namespace App\Filament\Resources\ContentItemResource\Pages;

use App\Filament\Resources\ContentItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContentItem extends ViewRecord
{
    protected static string $resource = ContentItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
