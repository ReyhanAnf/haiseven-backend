<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class QuotaSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?string $navigationLabel = 'Kuota AI';

    protected static ?string $title = 'Pengaturan Kuota AI';

    protected static string $view = 'filament.pages.quota-settings';

    public ?array $data = [];

    private const KEY_FREE = 'ai_free_daily_limit';
    private const KEY_PRO = 'ai_pro_daily_limit';
    private const KEY_BONUS = 'ai_bonus_per_streak';

    public function mount(): void
    {
        $this->form->fill($this->loadSettings());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Kuota Harian')
                    ->schema([
                        Forms\Components\TextInput::make('free_daily_limit')
                            ->label('Limit Harian Pengguna Gratis')
                            ->numeric()
                            ->minValue(0)
                            ->default(5)
                            ->required()
                            ->helperText('Jumlah pemeriksaan atau penggunaan AI harian bagi pengguna gratis.'),
                        Forms\Components\TextInput::make('pro_daily_limit')
                            ->label('Limit Harian Pengguna PRO')
                            ->numeric()
                            ->minValue(0)
                            ->default(30)
                            ->required()
                            ->helperText('Limit untuk pelanggan PRO, misalnya grammar check atau fitur AI lainnya.'),
                    ])->columns(2),
                Forms\Components\Section::make('Bonus & Pengganda')
                    ->schema([
                        Forms\Components\TextInput::make('bonus_per_streak')
                            ->label('Bonus Streak Harian')
                            ->numeric()
                            ->minValue(0)
                            ->default(2)
                            ->required()
                            ->helperText('Tambahan kuota saat user menjaga streak (opsional).'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();
        $freeLimit = (int) ($state['free_daily_limit'] ?? 0);
        $proLimit = (int) ($state['pro_daily_limit'] ?? 0);
        $bonus = (int) ($state['bonus_per_streak'] ?? 0);

        $this->persist(self::KEY_FREE, $freeLimit);
        $this->persist(self::KEY_PRO, $proLimit);
        $this->persist(self::KEY_BONUS, $bonus);

        Notification::make()
            ->title('Pengaturan kuota tersimpan')
            ->success()
            ->send();
    }

    private function loadSettings(): array
    {
        return [
            'free_daily_limit' => (int) $this->getValue(self::KEY_FREE, 5),
            'pro_daily_limit' => (int) $this->getValue(self::KEY_PRO, 30),
            'bonus_per_streak' => (int) $this->getValue(self::KEY_BONUS, 2),
        ];
    }

    private function getValue(string $key, int $default): int
    {
        $setting = Setting::query()->where('key', $key)->first();

        if (! $setting) {
            return $default;
        }

        return (int) ($setting->value ?? $default);
    }

    private function persist(string $key, int $value): void
    {
        Setting::query()->updateOrCreate(
            ['key' => $key],
            ['value' => (string) $value],
        );
    }
}
