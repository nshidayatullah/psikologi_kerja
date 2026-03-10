<?php

namespace App\Filament\Widgets;

class PengembanganKarirChart extends CategoryStressChart
{
    protected ?string $heading = 'Pengemb. Karir';
    protected static ?int $sort = 2;

    protected function getCategoryId(): int
    {
        return 5;
    }
    protected function getCategoryName(): string
    {
        return 'Pengembangan Karir';
    }
}
