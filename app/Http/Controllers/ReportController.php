<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveySession;
use App\Models\QuestionCategory;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function show($uuid)
    {
        $session = SurveySession::where('uuid', $uuid)->firstOrFail();

        // Load responses with answers and related question categories
        $session->load(['responses.answers.question']);

        $responses = $session->responses;

        $categories = QuestionCategory::all();

        // Prepare data for tables and charts
        $results = [];
        // [category_id => ['RINGAN' => 0, 'SEDANG' => 0, 'BERAT' => 0]]
        $summaryCounts = [];

        foreach ($categories as $cat) {
            $summaryCounts[$cat->id] = [
                'RINGAN' => 0,
                'SEDANG' => 0,
                'BERAT' => 0
            ];
        }

        foreach ($responses as $response) {
            $participantResult = [
                'id' => $response->id,
                'name' => $response->name,
                'position' => $response->position,
                'company' => $response->company,
                'department' => $response->department,
                'scores' => [],
                'categories_status' => []
            ];

            foreach ($categories as $cat) {
                $score = $response->answers
                    ->filter(fn($a) => $a->question->question_category_id == $cat->id)
                    ->sum('score');

                $status = $score <= 9 ? 'RINGAN' : ($score <= 24 ? 'SEDANG' : 'BERAT');

                $participantResult['scores'][$cat->id] = $score;
                $participantResult['categories_status'][$cat->id] = $status;

                $summaryCounts[$cat->id][$status]++;
            }

            // Build text summary for "Hasil Analisa" column
            $analisaTextParts = [];
            $groupedStatus = [
                'RINGAN' => [],
                'SEDANG' => [],
                'BERAT' => []
            ];

            foreach ($categories as $cat) {
                $groupedStatus[$participantResult['categories_status'][$cat->id]][] = strtolower($cat->name);
            }

            if (count($groupedStatus['BERAT']) > 0) {
                $analisaTextParts[] = "Tingkat risiko stres BERAT pada stresor " . implode(", ", $groupedStatus['BERAT']);
            }
            if (count($groupedStatus['SEDANG']) > 0) {
                $analisaTextParts[] = "Tingkat risiko stres SEDANG pada stresor " . implode(", ", $groupedStatus['SEDANG']);
            }
            if (count($groupedStatus['RINGAN']) > 0) {
                $analisaTextParts[] = "Tingkat risiko stres RINGAN pada stresor " . implode(", ", $groupedStatus['RINGAN']);
            }

            $participantResult['analisa_text'] = implode(". ", $analisaTextParts) . ".";

            $results[] = $participantResult;
        }

        // Prepare data for the Chart
        $totalParticipants = $responses->count();
        $chartData = [
            'labels' => $categories->pluck('name')->toArray(),
            'datasets' => [
                'RINGAN' => [],
                'SEDANG' => [],
                'BERAT' => []
            ],
            'percentages' => [
                'RINGAN' => [],
                'SEDANG' => [],
                'BERAT' => []
            ]
        ];

        foreach ($categories as $cat) {
            $chartData['datasets']['RINGAN'][] = $summaryCounts[$cat->id]['RINGAN'];
            $chartData['datasets']['SEDANG'][] = $summaryCounts[$cat->id]['SEDANG'];
            $chartData['datasets']['BERAT'][] = $summaryCounts[$cat->id]['BERAT'];

            $chartData['percentages']['RINGAN'][] = $totalParticipants > 0 ? round(($summaryCounts[$cat->id]['RINGAN'] / $totalParticipants) * 100, 2) : 0;
            $chartData['percentages']['SEDANG'][] = $totalParticipants > 0 ? round(($summaryCounts[$cat->id]['SEDANG'] / $totalParticipants) * 100, 2) : 0;
            $chartData['percentages']['BERAT'][] = $totalParticipants > 0 ? round(($summaryCounts[$cat->id]['BERAT'] / $totalParticipants) * 100, 2) : 0;
        }

        // Prepare percentage strings for the "Simpulan" section
        $percentages = [];
        if ($totalParticipants > 0) {
            foreach ($categories as $cat) {
                $percentages[$cat->id] = [
                    'RINGAN' => round(($summaryCounts[$cat->id]['RINGAN'] / $totalParticipants) * 100, 2),
                    'SEDANG' => round(($summaryCounts[$cat->id]['SEDANG'] / $totalParticipants) * 100, 2),
                    'BERAT' => round(($summaryCounts[$cat->id]['BERAT'] / $totalParticipants) * 100, 2),
                ];
            }
        } else {
            foreach ($categories as $cat) {
                $percentages[$cat->id] = ['RINGAN' => 0, 'SEDANG' => 0, 'BERAT' => 0];
            }
        }

        // Set basic variables
        $monthYear = Carbon::parse($session->created_at)->locale('id')->translatedFormat('F Y');
        $dateFormatted = Carbon::parse($session->created_at)->locale('id')->translatedFormat('d F Y');

        // We'll get department from the first response or "Berbagai Departemen"
        $departments = $responses->pluck('department')->unique()->filter()->values();
        $departmentName = $departments->count() == 1 ? $departments[0] : ($departments->count() > 1 ? 'Berbagai Departemen' : 'Tidak Disebutkan');

        // Fetch global signers as fallbacks
        $globalSigners = \App\Models\Signer::all()->keyBy('type');

        return view('public-report', compact(
            'session',
            'results',
            'categories',
            'chartData',
            'summaryCounts',
            'percentages',
            'monthYear',
            'dateFormatted',
            'departmentName',
            'totalParticipants',
            'globalSigners'
        ));
    }
}
