<?php

namespace App\Filament\Resources\Questions\Pages;

use App\Filament\Resources\Questions\QuestionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuestions extends ListRecords
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            'all' => \Filament\Schemas\Components\Tabs\Tab::make('Semua Pertanyaan')
                ->badge(\App\Models\Question::count()),
        ];

        $categories = \App\Models\QuestionCategory::withCount('questions')->get();

        foreach ($categories as $category) {
            $tabs[$category->id] = \Filament\Schemas\Components\Tabs\Tab::make($category->name)
                ->badge($category->questions_count)
                ->modifyQueryUsing(fn(\Illuminate\Database\Eloquent\Builder $query) => $query->where('question_category_id', $category->id));
        }

        return $tabs;
    }
}
