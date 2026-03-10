<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\SurveyResponse;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

abstract class CategoryStressChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 6;
    protected int | string | array $columnSpan = 1;
    protected ?string $maxHeight = '200px';


    abstract protected function getCategoryId(): int;
    abstract protected function getCategoryName(): string;

    protected function getData(): array
    {
        $sessionId = $this->filters['survey_session_id'] ?? null;
        $categoryId = $this->getCategoryId();

        $responses = SurveyResponse::with(['answers' => function ($query) use ($categoryId) {
            $query->whereHas('question', fn($q) => $q->where('question_category_id', $categoryId));
        }])
            ->when($sessionId, fn($q) => $q->where('survey_session_id', $sessionId))
            ->get();

        $ringan = 0;
        $sedang = 0;
        $berat = 0;

        foreach ($responses as $response) {
            $answers = $response->answers;
            if ($answers->isEmpty()) continue;

            $avgScore = $answers->avg('score');

            // Based on 1-7 scale:
            // Ringan: 1.0 - 2.33
            // Sedang: 2.34 - 4.66
            // Berat: 4.67 - 7.0
            if ($avgScore <= 2.33) {
                $ringan++;
            } elseif ($avgScore <= 4.66) {
                $sedang++;
            } else {
                $berat++;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Karyawan',
                    'data' => [$ringan, $sedang, $berat],
                    'backgroundColor' => ['#10b981', '#f59e0b', '#ef4444'], // Green, Orange, Red
                ],
            ],
            'labels' => ["Ringan ($ringan)", "Sedang ($sedang)", "Berat ($berat)"],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'usePointStyle' => true,
                        'boxWidth' => 6,
                    ],
                ],
                'datalabels' => [
                    'display' => true,
                    'color' => '#fff',
                    'font' => [
                        'weight' => 'bold',
                        'size' => 12,
                    ],
                    'formatter' => 'function(value) { return value > 0 ? value : ""; }',
                ],
            ],
        ];
    }
}
