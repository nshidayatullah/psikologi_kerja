<?php

namespace Database\Factories;

use App\Models\SurveyResponseAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurveyResponseAnswerFactory extends Factory
{
    protected $model = SurveyResponseAnswer::class;

    public function definition(): array
    {
        return [
            'score' => $this->faker->numberBetween(1, 5),
        ];
    }
}
