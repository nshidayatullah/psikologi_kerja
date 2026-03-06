<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SurveySession;
use App\Models\Question;
use App\Models\SurveyResponse;

class PublicSurveyForm extends Component
{
    public $uuid;
    public $session;
    public $questions;

    public $batch;
    public $date;
    public $company;
    public $department;
    public $position;
    public $name;

    public $answers = [];
    public $isSubmitted = false;
    public $finalScores = [];
    public $kategoriStres = '';

    public function mount($uuid)
    {
        $this->uuid = $uuid;
        $this->session = SurveySession::where('uuid', $uuid)->where('is_active', true)->firstOrFail();
        $this->questions = Question::where('is_active', true)->orderBy('number')->get();
        $this->date = date('Y-m-d');
        $this->batch = $this->session->title;
    }

    public function submit()
    {
        $this->validate([
            'date' => 'required|date',
            'company' => 'required',
            'department' => 'required',
            'position' => 'required',
            'name' => 'required',
            'answers' => 'required|array|size:' . $this->questions->count(),
            'answers.*' => 'required|integer|min:1|max:7',
        ]);

        $totalScore = collect($this->answers)->sum();

        $response = SurveyResponse::create([
            'survey_session_id' => $this->session->id,
            'batch' => strtoupper($this->batch),
            'date' => $this->date,
            'company' => strtoupper($this->company),
            'department' => strtoupper($this->department),
            'position' => strtoupper($this->position),
            'name' => strtoupper($this->name),
            'total_score' => $totalScore,
        ]);

        foreach ($this->answers as $questionId => $score) {
            $response->answers()->create([
                'question_id' => $questionId,
                'score' => $score,
            ]);
        }

        $kpScore = $response->answers->filter(fn($a) => $a->question->question_category_id == 1)->sum('score');
        $kopScore = $response->answers->filter(fn($a) => $a->question->question_category_id == 2)->sum('score');
        $bbkuanScore = $response->answers->filter(fn($a) => $a->question->question_category_id == 3)->sum('score');
        $bbkualScore = $response->answers->filter(fn($a) => $a->question->question_category_id == 4)->sum('score');
        $pkScore = $response->answers->filter(fn($a) => $a->question->question_category_id == 5)->sum('score');
        $tjScore = $response->answers->filter(fn($a) => $a->question->question_category_id == 6)->sum('score');

        // Calculate scores for each category
        $this->finalScores = [
            'Ketaksaan Peran' => $kpScore . ' (' . $this->getStressorCategory($kpScore) . ')',
            'Konflik Peran' => $kopScore . ' (' . $this->getStressorCategory($kopScore) . ')',
            'Beban Kuantitatif' => $bbkuanScore . ' (' . $this->getStressorCategory($bbkuanScore) . ')',
            'Beban Kualitatif' => $bbkualScore . ' (' . $this->getStressorCategory($bbkualScore) . ')',
            'Pengembangan Karir' => $pkScore . ' (' . $this->getStressorCategory($pkScore) . ')',
            'Tanggung Jawab' => $tjScore . ' (' . $this->getStressorCategory($tjScore) . ')',
            'Total Skor' => $totalScore,
        ];

        $this->kategoriStres = $totalScore <= 54 ? 'Ringan' : ($totalScore <= 144 ? 'Sedang' : 'Berat');

        $this->isSubmitted = true;
    }

    private function getStressorCategory($score)
    {
        if ($score <= 9) return 'RINGAN';
        if ($score <= 24) return 'SEDANG';
        return 'BERAT';
    }

    public function render()
    {
        return view('livewire.public-survey-form');
    }
}
