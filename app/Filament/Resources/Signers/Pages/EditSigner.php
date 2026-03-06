<?php

namespace App\Filament\Resources\Signers\Pages;

use App\Filament\Resources\Signers\SignerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSigner extends EditRecord
{
    protected static string $resource = SignerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
