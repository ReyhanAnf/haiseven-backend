<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LanguageLessonResource\Pages;
use App\Models\LanguageLesson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LanguageLessonResource extends Resource
{
    protected static ?string $model = LanguageLesson::class;

    protected static ?string $navigationGroup = 'Language Path';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Pelajaran')
                ->schema([
                    Forms\Components\Select::make('module_id')
                        ->label('Modul')
                        ->relationship('module', 'title')
                        ->searchable()
                        ->required(),
                    Forms\Components\TextInput::make('title')
                        ->label('Judul')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('order')
                        ->label('Urutan')
                        ->numeric()
                        ->minValue(1)
                        ->default(1),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('module.title')
                    ->label('Modul')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('questions_count')
                    ->label('Jumlah Soal')
                    ->counts('questions'),
            ])
            ->defaultSort('order')
            ->filters([
                Tables\Filters\SelectFilter::make('module_id')
                    ->label('Modul')
                    ->relationship('module', 'title'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLanguageLessons::route('/'),
            'create' => Pages\CreateLanguageLesson::route('/create'),
            'edit' => Pages\EditLanguageLesson::route('/{record}/edit'),
        ];
    }
}
