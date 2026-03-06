<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\SurveyResponse;

class StressorResultChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected ?string $heading = 'Distribusi Tingkat Stres per Dimensi/Stresor';
    protected ?string $maxHeight = '350px';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $responses = SurveyResponse::with('answers.question')->get();

        $categories = [
            1 => 'Ketaksaan Peran',
            2 => 'Konflik Peran',
            3 => 'Beban Kuantitatif',
            4 => 'Beban Kualitatif',
            5 => 'Pengembangan Karir',
            6 => 'Tanggung Jawab',
        ];

        $ringanData = [];
        $sedangData = [];
        $beratData = [];

        foreach ($categories as $categoryId => $name) {
            $ringanCount = 0;
            $sedangCount = 0;
            $beratCount = 0;

            foreach ($responses as $response) {
                // Sum scores for this specific category
                $score = $response->answers->filter(fn($a) => $a->question->question_category_id == $categoryId)->sum('score');

                if ($score <= 9) {
                    $ringanCount++;
                } elseif ($score <= 24) {
                    $sedangCount++;
                } else {
                    $beratCount++;
                }
            }

            $ringanData[] = $ringanCount;
            $sedangData[] = $sedangCount;
            $beratData[] = $beratCount;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Ringan (≤ 9)',
                    'data' => $ringanData,
                    'backgroundColor' => '#10b981', // Green
                ],
                [
                    'label' => 'Sedang (10-24)',
                    'data' => $sedangData,
                    'backgroundColor' => '#f59e0b', // Yellow
                ],
                [
                    'label' => 'Berat (> 24)',
                    'data' => $beratData,
                    'backgroundColor' => '#ef4444', // Red
                ],
            ],
            'labels' => array_values($categories),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'stacked' => false,
                ],
                'y' => [
                    'stacked' => false,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
