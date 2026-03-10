<?php

namespace App\Filament\Widgets;

class KetaksaanPeranChart extends CategoryStressChart
{
    protected ?string $heading = 'Ketaksaan Peran';
    protected static ?int $sort = 2;

    protected function getCategoryId(): int
    {
        return 1;
    }
    protected function getCategoryName(): string
    {
        return 'Ketaksaan Peran';
    }
}
