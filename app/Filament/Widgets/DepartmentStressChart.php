<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\SurveyResponse;
use Illuminate\Support\Facades\DB;

use Filament\Widgets\Concerns\InteractsWithPageFilters;

class DepartmentStressChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 11;
    protected int | string | array $columnSpan = 3;
    protected ?string $heading = 'Rata-rata Skor per Departemen';
    protected ?string $maxHeight = '400px';

    protected function getData(): array
    {
        $sessionId = $this->filters['survey_session_id'] ?? null;

        $data = SurveyResponse::select('department', DB::raw('AVG(total_score) as avg_score'))
            ->when($sessionId, fn($q) => $q->where('survey_session_id', $sessionId))
            ->groupBy('department')
            ->orderBy('avg_score', 'desc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Rata-rata Skor Total',
                    'data' => $data->pluck('avg_score')->toArray(),
                    'backgroundColor' => [
                        '#6366f1', // Indigo
                        '#10b981', // Emerald
                        '#f59e0b', // Amber
                        '#ef4444', // Red
                        '#3b82f6', // Blue
                        '#8b5cf6', // Violet
                        '#ec4899', // Pink
                        '#06b6d4', // Cyan
                        '#f97316', // Orange
                        '#84cc16', // Lime
                    ],
                ],
            ],
            'labels' => $data->pluck('department')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'scales' => [
                'x' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 210,
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
}
