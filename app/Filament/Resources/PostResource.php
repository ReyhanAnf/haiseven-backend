<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = 'Konten';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Section::make('Informasi Utama')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Judul')
                                ->required()
                                ->maxLength(255)
                                ->reactive()
                                ->afterStateUpdated(function (callable $set, callable $get, ?string $state) {
                                    if (! filled($state) || filled($get('slug'))) {
                                        return;
                                    }

                                    $set('slug', Str::slug($state));
                                }),
                            Forms\Components\TextInput::make('slug')
                                ->label('Slug')
                                ->required()
                                ->maxLength(255)
                                ->unique(table: 'posts', ignoreRecord: true)
                                ->hint('URL unik untuk artikel')
                                ->columnSpan(2),
                            Forms\Components\Textarea::make('excerpt')
                                ->label('Ringkasan')
                                ->rows(3)
                                ->maxLength(500)
                                ->columnSpanFull(),
                        ])->columns(2),
                    Forms\Components\Section::make('Konten')
                        ->schema([
                            Forms\Components\RichEditor::make('content')
                                ->label('Konten')
                                ->required()
                                ->columnSpanFull(),
                        ]),
                    Forms\Components\Section::make('Publikasi')
                        ->schema([
                            Forms\Components\Select::make('author_id')
                                ->label('Penulis')
                                ->relationship('author', 'name')
                                ->searchable()
                                ->required(),
                            Forms\Components\Toggle::make('is_published')
                                ->label('Terbitkan')
                                ->inline(false),
                            Forms\Components\DateTimePicker::make('published_at')
                                ->label('Terbit pada')
                                ->seconds(false)
                                ->helperText('Jika kosong, akan diisi otomatis saat diterbitkan.'),
                        ])->columns(3),
                ])->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Penulis')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Terbit')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Terbit')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Terbit'),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
