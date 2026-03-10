<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\SurveyResponse;
use App\Models\QuestionCategory;
use App\Models\SurveyResponseAnswer;

use Filament\Widgets\Concerns\InteractsWithPageFilters;

class RadarStressorChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 10;
    protected int | string | array $columnSpan = 3;
    protected ?string $heading = 'Analisis Dimensi Stres Kerja (Radar)';
    protected ?string $maxHeight = '400px';

    protected function getData(): array
    {
        $sessionId = $this->filters['survey_session_id'] ?? null;
        $categories = QuestionCategory::all();
        $labels = [];
        $values = [];

        foreach ($categories as $category) {
            $labels[] = $category->name;

            // Get average score for this category across all responses
            $avgScore = SurveyResponseAnswer::whereHas('response', function ($query) use ($sessionId) {
                $query->when($sessionId, fn($q) => $q->where('survey_session_id', $sessionId));
            })->whereHas('question', function ($query) use ($category) {
                $query->where('question_category_id', $category->id);
            })->avg('score') ?? 0;

            $values[] = round($avgScore, 2);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Rata-rata Skor Dimensi',
                    'data' => $values,
                    'fill' => true,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgb(54, 162, 235)',
                    'pointBackgroundColor' => 'rgb(54, 162, 235)',
                    'pointBorderColor' => '#fff',
                    'pointHoverBackgroundColor' => '#fff',
                    'pointHoverBorderColor' => 'rgb(54, 162, 235)'
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'radar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'r' => [
                    'angleLines' => [
                        'display' => true
                    ],
                    'suggestedMin' => 1,
                    'suggestedMax' => 7,
                ]
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
}
