<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\SurveySession;
use App\Models\SurveyResponse;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalSessions = SurveySession::count();
        $totalResponses = SurveyResponse::count();
        $avgScore = SurveyResponse::avg('total_score');

        return [
            Stat::make('Total Sesi Survei', $totalSessions)
                ->description('Survei yang telah dibuat')
                ->icon('heroicon-o-calendar'),
            Stat::make('Total Partisipan', $totalResponses)
                ->description('Karyawan yang mengisi survei')
                ->icon('heroicon-o-users'),
            Stat::make('Rata-rata Skor (Seluruh Sesi)', number_format((float)$avgScore, 2))
                ->description('Skor Stres Kerja')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}
