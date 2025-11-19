<?php

namespace App\Filament\Resources;

use App\Exports\LanguageModuleTemplateExport;
use App\Exports\LanguageModuleExport;
use App\Filament\Resources\LanguageModuleResource\Pages;
use App\Imports\LanguageModuleImport;
use App\Models\LanguageModule;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class LanguageModuleResource extends Resource
{
    protected static ?string $model = LanguageModule::class;

    protected static ?string $navigationGroup = 'Language Path';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Modul')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(4)
                        ->maxLength(1000)
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('order')
                        ->label('Urutan')
                        ->numeric()
                        ->minValue(1)
                        ->default(1),
                ])->columns(2),

            Forms\Components\Section::make('Struktur Pembelajaran')
                ->description('Kelola pelajaran dan soal dalam modul ini tanpa perlu berpindah halaman.')
                ->schema([
                    Forms\Components\Repeater::make('lessons')
                        ->label('Pelajaran')
                        ->relationship('lessons')
                        ->createItemButtonLabel('Tambah Pelajaran')
                        ->columns(2)
                        ->collapsible()
                        ->defaultItems(0)
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Judul Pelajaran')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(2),
                            Forms\Components\TextInput::make('order')
                                ->label('Urutan Pelajaran')
                                ->numeric()
                                ->minValue(1)
                                ->default(1),
                            Forms\Components\Repeater::make('questions')
                                ->label('Daftar Soal')
                                ->relationship('questions')
                                ->createItemButtonLabel('Tambah Soal')
                                ->columns(2)
                                ->collapsible()
                                ->collapsed()
                                ->defaultItems(0)
                                ->columnSpanFull()
                                ->schema([
                                    Forms\Components\Select::make('question_type')
                                        ->label('Tipe Soal')
                                        ->options([
                                            'multiple_choice' => 'Multiple Choice',
                                            'fill_in_blank' => 'Fill in the Blank',
                                        ])
                                        ->required()
                                        ->default('multiple_choice')
                                        ->columnSpan(1),
                                    Forms\Components\TextInput::make('correct_answer')
                                        ->label('Jawaban Benar')
                                        ->required()
                                        ->columnSpan(1),
                                    Forms\Components\Textarea::make('question')
                                        ->label('Pertanyaan')
                                        ->rows(3)
                                        ->required()
                                        ->columnSpanFull(),
                                    Forms\Components\TagsInput::make('options')
                                        ->label('Pilihan Jawaban')
                                        ->placeholder('Masukkan opsi lalu tekan enter')
                                        ->helperText('Hanya tampil untuk tipe multiple choice.')
                                        ->visible(fn (Get $get): bool => $get('question_type') === 'multiple_choice')
                                        ->columnSpanFull(),
                                ]),
                        ])
                        ->columnSpanFull(),
                ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lessons_count')
                    ->label('Jumlah Pelajaran')
                    ->counts('lessons'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
                ->defaultSort('order')
                ->filters([
                ])
                ->headerActions([
                    Tables\Actions\Action::make('downloadTemplate')
                        ->label('Unduh Template Excel')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function () {
                            return Excel::download(new LanguageModuleTemplateExport(), 'language-module-template.xlsx');
                        }),
                    Tables\Actions\Action::make('exportToExcel')
                        ->label('Export Semua ke Excel')
                        ->icon('heroicon-o-document-text')
                        ->color('secondary')
                        ->action(function () {
                            return Excel::download(new LanguageModuleExport(), 'language-module-export.xlsx');
                        }),
                    Tables\Actions\Action::make('importFromExcel')
                        ->label('Import dari Excel')
                        ->icon('heroicon-o-arrow-up-tray')
                        ->color('primary')
                        ->form([
                            Forms\Components\FileUpload::make('file')
                                ->label('File Excel (.xlsx)')
                                ->required()
                                ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                                ->directory('imports/language-modules')
                                ->disk('local')
                                ->visibility('private'),
                            Forms\Components\Toggle::make('replace_existing')
                                ->label('Kosongkan semua modul sebelum import')
                                ->helperText('Aktifkan bila ingin mengganti seluruh data modul dengan file ini.')
                                ->default(false),
                        ])
                        ->action(function (array $data): void {
                            $filePath = $data['file'] ?? null;

                            if (!$filePath) {
                                Notification::make()
                                    ->title('Import gagal')
                                    ->body('File Excel belum dipilih.')
                                    ->danger()
                                    ->send();

                                return;
                            }

                            try {
                                if (!Storage::disk('local')->exists($filePath)) {
                                    Notification::make()
                                        ->title('Import gagal')
                                        ->body('File tidak ditemukan. Silakan unggah ulang dan coba lagi.')
                                        ->danger()
                                        ->send();

                                    return;
                                }

                                $absolutePath = Storage::disk('local')->path($filePath);

                                $import = new LanguageModuleImport((bool) ($data['replace_existing'] ?? false));
                                Excel::import($import, $absolutePath);
                                $summary = $import->persist();

                                $message = sprintf(
                                    'Modul: %d baru, %d diperbarui. Pelajaran: %d baru, %d diperbarui. Soal: %d baru, %d diperbarui.',
                                    $summary['modules_created'],
                                    $summary['modules_updated'],
                                    $summary['lessons_created'],
                                    $summary['lessons_updated'],
                                    $summary['questions_created'],
                                    $summary['questions_updated']
                                );

                                $notification = Notification::make()
                                    ->title('Import selesai')
                                    ->body($message)
                                    ->success();

                                if ($summary['errors'] !== []) {
                                    $notes = implode(' | ', array_slice($summary['errors'], 0, 3));
                                    if (count($summary['errors']) > 3) {
                                        $notes .= ' | ...';
                                    }

                                    $notification
                                        ->title('Import selesai dengan catatan')
                                        ->body($message.'<br>Catatan: '.$notes.'<br>Detail lengkap tersimpan pada log aplikasi.')
                                        ->warning();
                                }

                                $notification->send();
                            } catch (Throwable $exception) {
                                report($exception);

                                Notification::make()
                                    ->title('Import gagal')
                                    ->body('Terjadi kesalahan saat memproses file: '.$exception->getMessage())
                                    ->danger()
                                    ->send();
                            } finally {
                                Storage::disk('local')->delete($filePath);
                            }
                        })
                        ->modalHeading('Import Modul dari Excel')
                        ->modalButton('Mulai Import'),
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
            'index' => Pages\ListLanguageModules::route('/'),
            'create' => Pages\CreateLanguageModule::route('/create'),
            'edit' => Pages\EditLanguageModule::route('/{record}/edit'),
        ];
    }
}
