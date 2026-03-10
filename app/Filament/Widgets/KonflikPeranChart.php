<?php

namespace App\Filament\Widgets;

class KonflikPeranChart extends CategoryStressChart
{
    protected ?string $heading = 'Konflik Peran';
    protected static ?int $sort = 2;

    protected function getCategoryId(): int
    {
        return 2;
    }
    protected function getCategoryName(): string
    {
        return 'Konflik Peran';
    }
}
