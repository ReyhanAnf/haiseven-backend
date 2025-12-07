<?php

namespace App\Filament\Actions;

use App\Models\ContentItem;
use App\Services\GeminiContentService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class GenerateMagicContentAction extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'generateMagicContent')
            ->label('Magic Generate')
            ->icon('heroicon-o-sparkles')
            ->color('primary')
            ->requiresConfirmation()
            ->modalHeading('Generate Content with AI')
            ->modalDescription('This will use Gemini to generate hooks, visual prompts, and captions based on the title and category. Existing content in these fields will be overwritten.')
            ->action(function (ContentItem $record, GeminiContentService $service) {
                if (!$record->title) {
                    Notification::make()
                        ->title('Title is required')
                        ->danger()
                        ->send();
                    return;
                }

                try {
                    $categoryName = $record->category ? $record->category->name : 'General';
                    $data = $service->generateContent($record->title, $categoryName);

                    $record->update([
                        'generated_hooks' => $data['hooks'] ?? [],
                        'generated_visual_prompts' => $data['visual_prompts'] ?? '',
                        'generated_captions' => $data['captions'] ?? '',
                    ]);

                    Notification::make()
                        ->title('Content Generated Successfully')
                        ->success()
                        ->send();

                } catch (\Exception $e) {
                    Notification::make()
                        ->title('Generation Failed')
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            });
    }
}
