<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\CheckboxList;
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
                    ->schema(function () {
                        $permissions = \Spatie\Permission\Models\Permission::all();

                        // Group permissions by model (last word of name)
                        $groupedPermissions = $permissions->groupBy(function ($permission) {
                            $name = $permission->name;
                            if (str_contains($name, '_')) {
                                return str($name)->afterLast('_')->title()->plural()->toString();
                            }
                            return 'Lainnya';
                        })->sortKeys();

                        $sections = [];
                        foreach ($groupedPermissions as $group => $items) {
                            $sections[] = Fieldset::make($group)
                                ->schema([
                                    CheckboxList::make('permissions')
                                        ->label('')
                                        ->relationship('permissions', 'name')
                                        ->options(
                                            $items->pluck('name', 'id')
                                                ->map(
                                                    fn($name) =>
                                                    str($name)
                                                        ->replace('_', ' ')
                                                        ->title()
                                                        ->toString()
                                                )
                                        )
                                        ->bulkToggleable()
                                        ->columns(4)
                                        ->gridDirection('vertical')
                                        ->columnSpanFull(),
                                ])
                                ->columnSpanFull();
                        }

                        return $sections;
                    })
                    ->columnSpanFull(),
            ]);
    }
}
