<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuestionCategory;

class SurveyResponse extends Model
{
    use HasFactory;
    protected $fillable = [
        'survey_session_id',
        'batch',
        'date',
        'company',
        'department',
        'position',
        'name',
        'total_score'
    ];

    public function session()
    {
        return $this->belongsTo(SurveySession::class, 'survey_session_id');
    }

    public function answers()
    {
        return $this->hasMany(SurveyResponseAnswer::class);
    }

    public function getAveragesByCategory(): array
    {
        $averages = [];
        $categories = QuestionCategory::all();

        foreach ($categories as $category) {
            $avgScore = $this->answers()
                ->whereHas('question', fn($q) => $q->where('question_category_id', $category->id))
                ->avg('score') ?? 0;

            $averages[$category->id] = round($avgScore, 2);
        }

        return $averages;
    }

    public function getTotalsByCategory(): array
    {
        $totals = [];
        $categories = QuestionCategory::all();

        foreach ($categories as $category) {
            $totalScore = $this->answers()
                ->whereHas('question', fn($q) => $q->where('question_category_id', $category->id))
                ->sum('score') ?? 0;

            $totals[$category->id] = $totalScore;
        }

        return $totals;
    }
}
