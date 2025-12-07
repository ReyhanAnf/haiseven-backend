<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentIdeaResource\Pages;
use App\Models\ContentIdea;
use App\Models\ContentItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class ContentIdeaResource extends Resource
{
    protected static ?string $model = ContentIdea::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?string $navigationGroup = 'Content Factory';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options([
                        'new' => 'New',
                        'converted_to_production' => 'Converted',
                        'discarded' => 'Discarded',
                    ])
                    ->default('new')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('content')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'info',
                        'converted_to_production' => 'success',
                        'discarded' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('promote')
                    ->label('Promote')
                    ->icon('heroicon-o-arrow-right-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (ContentIdea $record) => $record->status === 'new')
                    ->action(function (ContentIdea $record) {
                        ContentItem::create([
                            'title' => str($record->content)->limit(50),
                            'status' => 'idea',
                            'script_body' => $record->content,
                        ]);

                        $record->update(['status' => 'converted_to_production']);

                        Notification::make()
                            ->title('Promoted to Production')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListContentIdeas::route('/'),
            'create' => Pages\CreateContentIdea::route('/create'),
            'edit' => Pages\EditContentIdea::route('/{record}/edit'),
        ];
    }
}
