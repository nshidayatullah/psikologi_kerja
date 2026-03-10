<?php

namespace App\Filament\Widgets;

class TanggungJawabChart extends CategoryStressChart
{
    protected ?string $heading = 'Tanggung Jawab';
    protected static ?int $sort = 2;

    protected function getCategoryId(): int
    {
        return 6;
    }
    protected function getCategoryName(): string
    {
        return 'Tanggung Jawab';
    }
}
