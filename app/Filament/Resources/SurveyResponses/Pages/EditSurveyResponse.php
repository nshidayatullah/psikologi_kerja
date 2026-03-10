<?php

namespace App\Filament\Resources\SurveyResponses\Pages;

use App\Filament\Resources\SurveyResponses\SurveyResponseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditSurveyResponse extends EditRecord
{
    protected static string $resource = SurveyResponseResource::class;

    public function getMaxContentWidth(): Width
    {
        return Width::Full;
    }

    public function getExtraBodyAttributes(): array
    {
        return [
            'class' => 'fi-full-width-page',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function content(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return parent::content($schema)->columns(1);
    }
}
