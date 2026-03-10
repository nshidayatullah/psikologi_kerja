<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\SurveySession;
use App\Models\SurveyResponse;

use Filament\Widgets\Concerns\InteractsWithPageFilters;

class StatsOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $sessionId = $this->filters['survey_session_id'] ?? null;

        $totalSessions = SurveySession::count();
        $totalResponses = SurveyResponse::when($sessionId, fn($q) => $q->where('survey_session_id', $sessionId))->count();
        $avgScore = SurveyResponse::when($sessionId, fn($q) => $q->where('survey_session_id', $sessionId))->avg('total_score');

        $highRiskCount = SurveyResponse::when($sessionId, fn($q) => $q->where('survey_session_id', $sessionId))
            ->where('total_score', '>', 144)->count();

        return [
            Stat::make('Total Sesi Survei', $totalSessions)
                ->description('Survei yang telah dibuat')
                ->icon('heroicon-o-calendar'),
            Stat::make('Total Partisipan', $totalResponses)
                ->description('Karyawan yang mengisi survei')
                ->icon('heroicon-o-users'),
            Stat::make('Resiko Tinggi (Perhatian)', $highRiskCount)
                ->description('Karyawan butuh intervensi segera')
                ->icon('heroicon-o-exclamation-triangle')
                ->color('danger'),
            Stat::make('Rata-rata Skor (Seluruh Sesi)', number_format((float)$avgScore, 2))
                ->description('Skor Stres Kerja')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}
