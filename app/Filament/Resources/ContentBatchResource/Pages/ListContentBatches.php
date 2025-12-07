<?php

namespace App\Filament\Resources\ContentBatchResource\Pages;

use App\Filament\Resources\ContentBatchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContentBatches extends ListRecords
{
    protected static string $resource = ContentBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
