<?php

use App\Models\SurveyResponse;
use App\Models\SurveyResponseAnswer;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$categoryId = 1; // Ketaksaan Peran
$responses = SurveyResponse::with(['answers' => function ($query) use ($categoryId) {
    $query->whereHas('question', fn($q) => $q->where('question_category_id', $categoryId));
}])->get();

echo "Total Responses: " . $responses->count() . "\n";
$ringan = 0;
$sedang = 0;
$berat = 0;

foreach ($responses as $response) {
    $answers = $response->answers;
    echo "Resp {$response->id} answers count: " . $answers->count() . " avg: " . $answers->avg('score') . "\n";
    if ($answers->isEmpty()) continue;

    $avgScore = $answers->avg('score');
    if ($avgScore <= 2.33) $ringan++;
    elseif ($avgScore <= 4.66) $sedang++;
    else $berat++;
}

echo "Ringan: $ringan, Sedang: $sedang, Berat: $berat\n";
