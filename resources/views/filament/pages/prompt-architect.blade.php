<x-filament-panels::page>
    <form wire:submit="create">
        {{ $this->form }}
    </form>

    @if($generated_prompt)
        <x-filament::section class="mt-6">
            <x-slot name="heading">
                Generated Result
            </x-slot>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-4">
                    <div>
                        <h3 class="font-medium text-gray-500">Perfect Prompt</h3>
                        <div class="mt-2 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg relative group">
                            <p class="font-mono text-sm leading-relaxed">{{ $generated_prompt }}</p>
                            <button
                                type="button"
                                x-on:click="window.navigator.clipboard.writeText('{{ str_replace(["\r", "\n"], ' ', addslashes($generated_prompt)) }}'); $tooltip('Copied!');"
                                class="absolute top-2 right-2 text-gray-400 hover:text-primary-500"
                            >
                                <x-heroicon-m-clipboard class="w-5 h-5" />
                            </button>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h3 class="font-medium text-gray-500">Recommended Tool</h3>
                        <div class="mt-2 text-lg font-bold text-primary-600">
                            {{ $recommended_tool }}
                        </div>
                    </div>

                    @if($tips)
                        <div>
                            <h3 class="font-medium text-gray-500">Pro Tip</h3>
                            <div class="mt-2 text-sm text-gray-600 dark:text-gray-400 bg-yellow-50 dark:bg-yellow-900/20 p-3 rounded border border-yellow-200 dark:border-yellow-800">
                                {{ $tips }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </x-filament::section>
    @endif
</x-filament-panels::page>
