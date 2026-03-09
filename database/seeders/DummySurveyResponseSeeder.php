<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\SurveyResponse;
use App\Models\SurveyResponseAnswer;
use App\Models\SurveySession;
use App\Models\Signer;
use Illuminate\Database\Seeder;

class DummySurveyResponseSeeder extends Seeder
{
    public function run(): void
    {
        $session = SurveySession::first();

        if (!$session) {
            $pic1 = Signer::where('type', 'pic1')->first();
            $pic2 = Signer::where('type', 'pic2')->first();
            $reviewer = Signer::where('type', 'reviewer')->first();

            $session = SurveySession::create([
                'title' => 'Sesi Survey Dummy',
                'is_active' => true,
                'pic1_name' => $pic1->name ?? 'M. Hidayatullah',
                'pic1_role' => $pic1->role ?? 'Safety Officer',
                'pic2_name' => $pic2->name ?? 'Zulkifli',
                'pic2_role' => $pic2->role ?? 'Paramedic',
                'reviewer_name' => $reviewer->name ?? 'dr. Haamim Sajdah Sya\'ban',
                'reviewer_role' => $reviewer->role ?? 'Corporate Doctor',
            ]);
        }

        $questions = Question::all();

        if ($questions->isEmpty()) {
            $this->command->error('No questions found. Please seed QuestionSeeder first.');
            return;
        }

        $this->command->info("Creating 45 dummy respondents for session: {$session->title}");

        SurveyResponse::factory()
            ->count(45)
            ->create(['survey_session_id' => $session->id])
            ->each(function ($response) use ($questions) {
                $totalScore = 0;
                foreach ($questions as $question) {
                    $score = fake()->numberBetween(1, 4); // SDS usually 1-4 or 1-5
                    SurveyResponseAnswer::create([
                        'survey_response_id' => $response->id,
                        'question_id' => $question->id,
                        'score' => $score,
                    ]);
                    $totalScore += $score;
                }
                $response->update(['total_score' => $totalScore]);
            });

        $this->command->info('Dummy respondents created successfully.');
    }
}
