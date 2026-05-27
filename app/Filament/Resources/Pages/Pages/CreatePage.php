<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;

use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    
    protected static string $resource = PageResource::class;

 protected function onValidationError(\Illuminate\Validation\ValidationException $exception): void
{
    // Это выведет все ошибки валидации прямо в "уведомление" (Notification) в углу экрана
    \Filament\Notifications\Notification::make()
        ->title('Ошибка валидации!')
        ->body(collect($exception->errors())->flatten()->implode(' | '))
        ->danger()
        ->send();
}
}
