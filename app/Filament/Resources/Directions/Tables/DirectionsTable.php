<?php

namespace App\Filament\Resources\Directions\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DirectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->reorderRecordsTriggerAction(
            fn (Action $action, bool $isReordering) => $action
                    ->button()
                    ->label($isReordering ? 'Выключить пересортировку' : 'Включить пересортировку'),
            )
            ->columns([
                TextColumn::make('title')
                    ->label('Название')
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Ярлык')
                    ->searchable(),
                TextColumn::make('sort_order')->label('Порядок')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('publish')->label('Публикация')
                    ->boolean(),

                TextColumn::make('created_at')->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label('Дата обновления')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
 
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
