<?php

namespace App\Filament\Resources\Permissions\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class PermissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Permission')
                    ->formatStateUsing(
                        fn(string $state): string =>
                        str($state)
                            ->replace('_', ' ')
                            ->title()
                            ->toString()
                    )
                    ->badge()
                    ->color(fn(string $state): string => match (true) {
                        str_contains($state, 'view') => 'info',
                        str_contains($state, 'create') => 'success',
                        str_contains($state, 'update') => 'warning',
                        str_contains($state, 'delete') => 'danger',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('group')
                    ->label('Grup')
                    ->getStateUsing(
                        fn($record): string =>
                        str($record->name)
                            ->afterLast('_')
                            ->plural()
                            ->title()
                            ->toString()
                    )
                    ->badge()
                    ->color('gray')
                    ->searchable(['name']),
                TextColumn::make('guard_name')
                    ->label('Guard')
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
