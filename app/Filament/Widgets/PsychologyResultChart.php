<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\SurveyResponse;

class PsychologyResultChart extends ChartWidget
{
    protected ?string $heading = 'Persentase Tingkat Stres';

    protected function getData(): array
    {
        $ringan = SurveyResponse::where('total_score', '<=', 54)->count();
        $sedang = SurveyResponse::whereBetween('total_score', [55, 144])->count();
        $berat = SurveyResponse::where('total_score', '>', 144)->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Karyawan',
                    'data' => [$ringan, $sedang, $berat],
                    'backgroundColor' => ['#10b981', '#f59e0b', '#ef4444'], // Green, Orange, Red
                ],
            ],
            'labels' => ['Ringan', 'Sedang', 'Berat'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
