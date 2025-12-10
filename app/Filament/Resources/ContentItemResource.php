<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentItemResource\Pages;
use App\Models\ContentItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class ContentItemResource extends Resource
{
    protected static ?string $model = ContentItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $navigationGroup = 'Content Factory';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Content')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                        Forms\Components\RichEditor::make('script_body')
                                            ->label('Script')
                                            ->columnSpanFull()
                                            ->hintAction(
                                                Forms\Components\Actions\Action::make('copy')
                                                    ->icon('heroicon-m-clipboard')
                                                    ->action(function ($livewire, $state) {
                                                        $livewire->js("window.navigator.clipboard.writeText('{$state}')");
                                                        Notification::make()->title('Script copied!')->success()->send();
                                                    })
                                            ),
                                    ]),
                                Forms\Components\Section::make('AI Generated Extras')
                                    ->schema([
                                        Forms\Components\KeyValue::make('generated_hooks')
                                            ->label('Generated Hooks')
                                            ->keyLabel('Hook Type')
                                            ->valueLabel('Hook Text')
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('generated_captions')
                                            ->label('Captions & Hashtags')
                                            ->rows(4)
                                            ->columnSpanFull()
                                            ->hintAction(
                                                Forms\Components\Actions\Action::make('copy')
                                                    ->icon('heroicon-m-clipboard')
                                                    ->action(function ($livewire, $state) {
                                                        $livewire->js("window.navigator.clipboard.writeText('{$state}')");
                                                        Notification::make()->title('Captions copied!')->success()->send();
                                                    })
                                            ),
                                        Forms\Components\Textarea::make('generated_visual_prompts')
                                            ->label('Visual Prompts')
                                            ->rows(4)
                                            ->columnSpanFull(),
                                    ])
                                    ->collapsible(),
                            ])
                            ->columnSpan(['lg' => 2]),

                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Status & Organization')
                                    ->schema([
                                        Forms\Components\Select::make('status')
                                            ->options([
                                                'idea' => 'Idea',
                                                'scripting' => 'Scripting',
                                                'dubbing' => 'Dubbing',
                                                'editing' => 'Editing',
                                                'ready_to_upload' => 'Ready to Upload',
                                                'posted' => 'Posted',
                                            ])
                                            ->required()
                                            ->default('idea'),
                                        Forms\Components\Select::make('batch_id')
                                            ->relationship('batch', 'name')
                                            ->searchable()
                                            ->preload(),
                                        Forms\Components\Select::make('category_id')
                                            ->relationship('category', 'name')
                                            ->searchable()
                                            ->preload(),
                                    ]),
                                Forms\Components\Section::make('Distribution')
                                    ->schema([
                                        Forms\Components\TextInput::make('google_drive_link')
                                            ->url()
                                            ->suffixIcon('heroicon-m-link'),
                                        Forms\Components\Group::make()
                                            ->schema([
                                                Forms\Components\Toggle::make('platform_tiktok')
                                                    ->label('TikTok'),
                                                Forms\Components\Toggle::make('platform_reels')
                                                    ->label('Reels'),
                                                Forms\Components\Toggle::make('platform_shorts')
                                                    ->label('Shorts'),
                                            ])->columns(1),
                                    ]),
                            ])
                            ->columnSpan(['lg' => 1]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'idea' => 'gray',
                        'scripting' => 'info',
                        'dubbing' => 'warning',
                        'editing' => 'warning',
                        'ready_to_upload' => 'success',
                        'posted' => 'success',
                    }),
                Tables\Columns\TextColumn::make('category.name')
                    ->badge()
                    ->color(fn ($record) => $record->category?->color ?? 'gray'),
                Tables\Columns\TextColumn::make('batch.name')
                    ->sortable(),
                Tables\Columns\IconColumn::make('platform_tiktok')
                    ->label('TikTok')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('platform_reels')
                    ->label('Reels')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('platform_shorts')
                    ->label('Shorts')
                    ->boolean()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'idea' => 'Idea',
                        'scripting' => 'Scripting',
                        'dubbing' => 'Dubbing',
                        'editing' => 'Editing',
                        'ready_to_upload' => 'Ready to Upload',
                        'posted' => 'Posted',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('batch')
                    ->relationship('batch', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Split::make([
                    \Filament\Infolists\Components\Section::make('The Teleprompter')
                        ->schema([
                            \Filament\Infolists\Components\TextEntry::make('script_body')
                                ->label('')
                                ->html()
                                ->extraAttributes(['class' => 'prose prose-lg dark:prose-invert max-w-none'])
                                ->hintAction(
                                    \Filament\Infolists\Components\Actions\Action::make('copyScript')
                                        ->icon('heroicon-m-clipboard')
                                        ->label('Copy Full Script')
                                        ->action(function ($record, $livewire) {
                                            $script = strip_tags($record->script_body); // Strip HTML for clipboard
                                            $livewire->js("window.navigator.clipboard.writeText(`{$script}`)");
                                            Notification::make()->title('Script copied!')->success()->send();
                                        })
                                ),
                        ])->grow(),
                    \Filament\Infolists\Components\Section::make('Social Media Card')
                        ->schema([
                            \Filament\Infolists\Components\TextEntry::make('status')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'idea' => 'gray',
                                    'scripting' => 'info',
                                    'dubbing' => 'warning',
                                    'editing' => 'warning',
                                    'ready_to_upload' => 'success',
                                    'posted' => 'success',
                                }),
                            \Filament\Infolists\Components\TextEntry::make('generated_hooks')
                                ->label('Viral Hooks')
                                ->listWithLineBreaks()
                                ->formatStateUsing(fn ($state) => is_array($state) ? implode("\n", $state) : $state),
                            \Filament\Infolists\Components\TextEntry::make('generated_captions')
                                ->label('Captions')
                                ->markdown(),
                            \Filament\Infolists\Components\TextEntry::make('generated_visual_prompts')
                                ->label('Visual Ideas')
                                ->markdown(),
                            \Filament\Infolists\Components\Group::make([
                                \Filament\Infolists\Components\IconEntry::make('platform_tiktok')->label('TikTok')->boolean(),
                                \Filament\Infolists\Components\IconEntry::make('platform_reels')->label('Reels')->boolean(),
                                \Filament\Infolists\Components\IconEntry::make('platform_shorts')->label('Shorts')->boolean(),
                            ])->columns(3),
                            \Filament\Infolists\Components\TextEntry::make('google_drive_link')
                                ->label('Drive Link')
                                ->url(fn ($state) => $state)
                                ->icon('heroicon-m-link')
                                ->openUrlInNewTab(),
                        ])->grow(false),
                ])->from('md'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContentItems::route('/'),
            'create' => Pages\CreateContentItem::route('/create'),
            'view' => Pages\ViewContentItem::route('/{record}'),
            'edit' => Pages\EditContentItem::route('/{record}/edit'),
        ];
    }
}
