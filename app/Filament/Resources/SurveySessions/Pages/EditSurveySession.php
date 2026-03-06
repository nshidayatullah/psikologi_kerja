<?php

namespace App\Filament\Resources\SurveySessions\Pages;

use App\Filament\Resources\SurveySessions\SurveySessionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSurveySession extends EditRecord
{
    protected static string $resource = SurveySessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
