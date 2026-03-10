<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Role')
                    ->description('Kelola nama role dan guard di sini.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Role')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('guard_name')
                            ->label('Guard')
                            ->default('web')
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Hak Akses (Permissions)')
                    ->description('Pilih hak akses yang akan diberikan ke role ini, dikelompokkan berdasarkan modul.')
                    ->schema([
                        Tabs::make('Permissions')
                            ->tabs(function () {
                                $permissions = \Spatie\Permission\Models\Permission::all();
                                $groupedPermissions = $permissions->groupBy(function ($permission) {
                                    $name = $permission->name;
                                    if (str_contains($name, '_')) {
                                        return str($name)->afterLast('_')->title()->plural()->toString();
                                    }
                                    return 'Lainnya';
                                })->sortKeys();

                                $tabs = [];
                                foreach ($groupedPermissions as $group => $items) {
                                    $safeGroupName = str($group)->slug('_')->toString();
                                    $tabs[] = Tab::make($group)
                                        ->schema([
                                            CheckboxList::make("permissions_{$safeGroupName}")
                                                ->label('')
                                                ->options(
                                                    $items->pluck('name', 'id')
                                                        ->map(fn($name) => str($name)->replace('_', ' ')->title()->toString())
                                                )
                                                ->dehydrated(false)
                                                ->afterStateHydrated(function ($component, $record) use ($items) {
                                                    if (!$record) return;
                                                    $ids = $items->pluck('id')->toArray();
                                                    $selected = $record->permissions->whereIn('id', $ids)->pluck('id')->toArray();
                                                    $component->state($selected);
                                                })
                                                ->bulkToggleable()
                                                ->columns(4)
                                                ->gridDirection('vertical'),
                                        ]);
                                }

                                return $tabs;
                            })
                            ->columnSpanFull(),

                        \Filament\Forms\Components\Hidden::make('sync_permissions')
                            ->dehydrated(true)
                            ->saveRelationshipsUsing(function ($component, $record, $state, $get) {
                                $permissions = \Spatie\Permission\Models\Permission::all();
                                $groupedPermissions = $permissions->groupBy(function ($permission) {
                                    $name = $permission->name;
                                    if (str_contains($name, '_')) {
                                        return str($name)->afterLast('_')->title()->plural()->toString();
                                    }
                                    return 'Lainnya';
                                });

                                $allSelectedIds = [];
                                foreach ($groupedPermissions as $group => $items) {
                                    $safeGroupName = str($group)->slug('_')->toString();
                                    $selectedForGroup = $get("permissions_{$safeGroupName}") ?? [];
                                    $allSelectedIds = array_merge($allSelectedIds, $selectedForGroup);
                                }

                                $record->syncPermissions($allSelectedIds);
                            }),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
