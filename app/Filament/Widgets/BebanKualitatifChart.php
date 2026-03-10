<?php

namespace App\Filament\Widgets;

class BebanKualitatifChart extends CategoryStressChart
{
    protected ?string $heading = 'Beban Kualitatif';
    protected static ?int $sort = 2;

    protected function getCategoryId(): int
    {
        return 4;
    }
    protected function getCategoryName(): string
    {
        return 'Beban Kualitatif';
    }
}
