<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LanguageQuestionResource\Pages;
use App\Models\LanguageQuestion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LanguageQuestionResource extends Resource
{
    protected static ?string $model = LanguageQuestion::class;

    protected static ?string $navigationGroup = 'Language Path';

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Soal')
                ->schema([
                    Forms\Components\Select::make('lesson_id')
                        ->label('Pelajaran')
                        ->relationship('lesson', 'title')
                        ->searchable()
                        ->required(),
                    Forms\Components\Select::make('question_type')
                        ->label('Tipe Soal')
                        ->options([
                            'multiple_choice' => 'Multiple Choice',
                            'fill_in_blank' => 'Fill in the Blank',
                        ])
                        ->required(),
                    Forms\Components\Textarea::make('question')
                        ->label('Pertanyaan')
                        ->rows(4)
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TagsInput::make('options')
                        ->label('Pilihan Jawaban')
                        ->placeholder('Masukkan opsi dan tekan enter')
                        ->helperText('Opsional untuk tipe fill-in-the-blank.')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('correct_answer')
                        ->label('Jawaban Benar')
                        ->required(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lesson.module.title')
                    ->label('Modul')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('lesson.title')
                    ->label('Pelajaran')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('question_type')
                    ->label('Tipe')
                    ->colors([
                        'primary',
                        'warning' => 'fill_in_blank',
                    ])
                    ->formatStateUsing(fn (?string $state): ?string => match ($state) {
                        'multiple_choice' => 'Multiple Choice',
                        'fill_in_blank' => 'Fill in the Blank',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('question')
                    ->label('Pertanyaan')
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->question),
                Tables\Columns\TagsColumn::make('options')
                    ->label('Pilihan')
                    ->limit(2),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('lesson_id')
                    ->label('Pelajaran')
                    ->relationship('lesson', 'title'),
                Tables\Filters\SelectFilter::make('question_type')
                    ->label('Tipe Soal')
                    ->options([
                        'multiple_choice' => 'Multiple Choice',
                        'fill_in_blank' => 'Fill in the Blank',
                    ]),
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
            'index' => Pages\ListLanguageQuestions::route('/'),
            'create' => Pages\CreateLanguageQuestion::route('/create'),
            'edit' => Pages\EditLanguageQuestion::route('/{record}/edit'),
        ];
    }
}
