<?php

namespace App\Filament\Resources\SurveyResponses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;

class SurveyResponseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profil & Analisis Hasil Survei')
                    ->maxWidth(Width::Full)
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        \Filament\Schemas\Components\Group::make([
                            \Filament\Forms\Components\Select::make('survey_session_id')
                                ->relationship('session', 'title')
                                ->label('Sesi Survei')
                                ->required(),
                            TextInput::make('batch')
                                ->label('Batch/Angkatan')
                                ->required(),
                            DatePicker::make('date')
                                ->label('Tanggal')
                                ->required(),
                            TextInput::make('company')
                                ->label('Perusahaan')
                                ->required(),
                            TextInput::make('department')
                                ->label('Departemen/Divisi')
                                ->required(),
                            TextInput::make('position')
                                ->label('Jabatan')
                                ->required(),
                            TextInput::make('name')
                                ->label('Nama Pekerja')
                                ->required(),
                            TextInput::make('total_score')
                                ->label('Total Skor')
                                ->disabled()
                                ->numeric(),
                        ])
                            ->columns(2)
                            ->columnSpan(1),

                        View::make('filament.widgets.individual-radar-chart')
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
