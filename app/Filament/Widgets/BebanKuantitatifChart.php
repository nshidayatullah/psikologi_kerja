<?php

namespace App\Filament\Widgets;

class BebanKuantitatifChart extends CategoryStressChart
{
    protected ?string $heading = 'Beban Kuantitatif';
    protected static ?int $sort = 2;

    protected function getCategoryId(): int
    {
        return 3;
    }
    protected function getCategoryName(): string
    {
        return 'Beban Kuantitatif';
    }
}
