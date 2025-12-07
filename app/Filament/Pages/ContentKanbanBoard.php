<?php

namespace App\Filament\Pages;

use App\Models\ContentItem;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;

class ContentKanbanBoard extends KanbanBoard
{
    protected static string $model = ContentItem::class;
    protected static string $statusEnum = 'status'; // We can use the column name here if not using Enum class
    protected static ?string $navigationIcon = 'heroicon-o-view-columns';
    protected static ?string $navigationGroup = 'Content Factory';
    protected static ?string $title = 'Content Workflow';

    protected function statuses(): \Illuminate\Support\Collection
    {
        return collect([
            [
                'id' => 'idea',
                'title' => 'Idea',
            ],
            [
                'id' => 'scripting',
                'title' => 'Scripting',
            ],
            [
                'id' => 'dubbing',
                'title' => 'Dubbing',
            ],
            [
                'id' => 'editing',
                'title' => 'Editing',
            ],
            [
                'id' => 'ready_to_upload',
                'title' => 'Ready',
            ],
            [
                'id' => 'posted',
                'title' => 'Posted',
            ],
        ]);
    }

    protected function records(): \Illuminate\Support\Collection
    {
        return ContentItem::query()
            ->with(['category'])
            ->get();
    }

    public function onStatusChanged($recordId, $status, $fromOrderedIds, $toOrderedIds): void
    {
        ContentItem::find($recordId)->update(['status' => $status]);
    }

    protected function getEditModalFormSchema($recordId): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            //
        ];
    }

    // Customizing the card view is usually done by overriding the view or using specific methods
    // filament-kanban allows overriding `kanban-card` view or using `additionalRecordData`
    // However, for simple customization, we might need to publish views or just rely on title.
    // The requirement says: "Cards should show Title, Category badge, and Platform icons."
    // This usually requires a custom view.
    // I will check if I can define a view.
    // Since I cannot easily create a blade view in the correct vendor path, I will check if I can use `view` property.
    // But `filament-kanban` is opinionated.
    // I'll stick to the basic implementation first.
}
