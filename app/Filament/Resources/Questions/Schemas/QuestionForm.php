<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('question_category_id')
                    ->relationship('category', 'name')
                    ->label('Kategori')
                    ->required(),
                TextInput::make('number')
                    ->label('Nomor Pertanyaan')
                    ->required()
                    ->numeric(),
                Textarea::make('body')
                    ->label('Isi Pertanyaan')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Aktif?')
                    ->default(true)
                    ->required(),
            ]);
    }
}
