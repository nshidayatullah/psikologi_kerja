<?php

namespace Database\Factories;

use App\Models\SurveyResponse;
use App\Models\SurveySession;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurveyResponseFactory extends Factory
{
    protected $model = SurveyResponse::class;

    public function definition(): array
    {
        return [
            'survey_session_id' => SurveySession::first()?->id ?? SurveySession::factory(),
            'batch' => 'Batch 1',
            'date' => now()->format('Y-m-d'),
            'company' => 'PT. Putra Perkasa Abadi',
            'department' => $this->faker->randomElement(['Production', 'Engineering', 'HCGS', 'Safety', 'Maintenance']),
            'position' => $this->faker->jobTitle(),
            'name' => $this->faker->name(),
            'total_score' => 0, // Will be updated after answers are created
        ];
    }
}
