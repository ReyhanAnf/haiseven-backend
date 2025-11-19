<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionResource\Pages;
use App\Models\Subscription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationGroup = 'Manajemen Data';

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Langganan')
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('Pengguna')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->required(),
                    Forms\Components\TextInput::make('plan_name')
                        ->label('Nama Paket')
                        ->maxLength(255)
                        ->required(),
                    Forms\Components\DateTimePicker::make('expires_at')
                        ->label('Tanggal Kedaluwarsa')
                        ->timezone(config('app.timezone')),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('plan_name')
                    ->label('Nama Paket')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('expires_at')
                    ->label('Kedaluwarsa')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('aktif')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Aktif pada')
                            ->default(now()->format('Y-m-d')),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (! ($data['tanggal'] ?? null)) {
                            return $query;
                        }

                        return $query->where(function (Builder $subQuery) use ($data) {
                            $subQuery
                                ->whereNull('expires_at')
                                ->orWhere('expires_at', '>=', $data['tanggal']);
                        });
                    }),
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
            'index' => Pages\ListSubscriptions::route('/'),
            'create' => Pages\CreateSubscription::route('/create'),
            'edit' => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }
}
