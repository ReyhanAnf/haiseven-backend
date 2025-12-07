<?php

namespace App\Filament\Resources\ContentBatchResource\Pages;

use App\Filament\Resources\ContentBatchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContentBatch extends EditRecord
{
    protected static string $resource = ContentBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
