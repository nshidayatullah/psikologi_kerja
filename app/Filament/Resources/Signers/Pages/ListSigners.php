<?php

namespace App\Filament\Resources\Signers\Pages;

use App\Filament\Resources\Signers\SignerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSigners extends ListRecords
{
    protected static string $resource = SignerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
