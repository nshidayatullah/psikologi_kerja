<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use App\Models\SurveySession;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Select::make('survey_session_id')
                            ->label('Judul Sesi Survey')
                            ->placeholder('Semua Sesi')
                            ->options(SurveySession::pluck('title', 'id'))
                            ->searchable(),
                    ])
                    ->columns(1),
            ]);
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatsOverview::class,
            \App\Filament\Widgets\KetaksaanPeranChart::class,
            \App\Filament\Widgets\KonflikPeranChart::class,
            \App\Filament\Widgets\BebanKuantitatifChart::class,
            \App\Filament\Widgets\BebanKualitatifChart::class,
            \App\Filament\Widgets\PengembanganKarirChart::class,
            \App\Filament\Widgets\TanggungJawabChart::class,
            \App\Filament\Widgets\RadarStressorChart::class,
            \App\Filament\Widgets\DepartmentStressChart::class,
        ];
    }

    public function getColumns(): int | array
    {
        return 6;
    }
}
