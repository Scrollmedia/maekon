<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col gap-y-3">
            <h3 class="text-sm font-medium text-gray-500">Быстрые действия</h3>
            <br>
             <br>
            <!-- Кнопка очистки кэша -->
            <x-filament::button 
                wire:click="clearCache" 
                color="danger" 
                icon="heroicon-m-trash"
                wire:loading.attr="disabled"
            >
                Очистить весь кэш
            </x-filament::button>
 
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
