<?php

namespace App\Filament\Resources\QuestionCategories;

use App\Filament\Resources\QuestionCategories\Pages\CreateQuestionCategory;
use App\Filament\Resources\QuestionCategories\Pages\EditQuestionCategory;
use App\Filament\Resources\QuestionCategories\Pages\ListQuestionCategories;
use App\Filament\Resources\QuestionCategories\Schemas\QuestionCategoryForm;
use App\Filament\Resources\QuestionCategories\Tables\QuestionCategoriesTable;
use App\Models\QuestionCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QuestionCategoryResource extends Resource
{
    protected static ?string $model = QuestionCategory::class;

    protected static ?string $modelLabel = 'Kategori Pertanyaan';
    protected static ?string $pluralModelLabel = 'Kategori Pertanyaan';
    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Kuesioner';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    public static function form(Schema $schema): Schema
    {
        return QuestionCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuestionCategoriesTable::configure($table);
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
            'index' => ListQuestionCategories::route('/'),
            'create' => CreateQuestionCategory::route('/create'),
            'edit' => EditQuestionCategory::route('/{record}/edit'),
        ];
    }
}
