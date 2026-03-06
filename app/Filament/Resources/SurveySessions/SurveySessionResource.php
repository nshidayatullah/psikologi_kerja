<?php

namespace App\Filament\Resources\SurveySessions;

use App\Filament\Resources\SurveySessions\Pages\CreateSurveySession;
use App\Filament\Resources\SurveySessions\Pages\EditSurveySession;
use App\Filament\Resources\SurveySessions\Pages\ListSurveySessions;
use App\Filament\Resources\SurveySessions\Schemas\SurveySessionForm;
use App\Filament\Resources\SurveySessions\Tables\SurveySessionsTable;
use App\Models\SurveySession;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SurveySessionResource extends Resource
{
    protected static ?string $model = SurveySession::class;

    protected static ?string $modelLabel = 'Sesi Survei';
    protected static ?string $pluralModelLabel = 'Sesi Survei';
    protected static string|\UnitEnum|null $navigationGroup = 'Pelaksanaan Survei';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return SurveySessionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SurveySessionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSurveySessions::route('/'),
            'create' => CreateSurveySession::route('/create'),
            'edit' => EditSurveySession::route('/{record}/edit'),
        ];
    }
}
