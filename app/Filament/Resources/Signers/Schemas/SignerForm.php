<?php

namespace App\Filament\Resources\Signers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SignerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('type')
                    ->label('ID')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('label')
                    ->label('Kategori')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                TextInput::make('role')
                    ->label('Jabatan / Gelar')
                    ->maxLength(255),
            ]);
    }
}
