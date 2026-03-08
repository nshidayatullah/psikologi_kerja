<?php

namespace App\Filament\Resources\Permissions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PermissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Permission')
                    ->description('Detail untuk hak akses spesifik di aplikasi.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Permission')
                            ->helperText('Contoh: view_any_user, create_survey_session')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('guard_name')
                            ->label('Guard')
                            ->helperText('Default: web')
                            ->default('web')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
