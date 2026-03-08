<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveySession;
use App\Models\QuestionCategory;
use Carbon\Carbon;
use setasign\Fpdi\Fpdi;

class ReportController extends Controller
{
    public function show($uuid)
    {
        $data = $this->getReportData($uuid);
        return view('public-report', array_merge($data, ['is_pdf' => false]));
    }

    public function download($uuid)
    {
        set_time_limit(0);
        $data = $this->getReportData($uuid);

        $sections = [
            ['id' => 'cover',        'orientation' => 'portrait',  'margins' => [0, 0, 0, 0]],
            ['id' => 'approval',     'orientation' => 'portrait',  'margins' => [10, 5, 5, 10]],
            ['id' => 'introduction', 'orientation' => 'portrait',  'margins' => [10, 10, 5, 20]],
            ['id' => 'methodology',  'orientation' => 'portrait',  'margins' => [10, 10, 5, 20]],
            ['id' => 'table',        'orientation' => 'landscape', 'margins' => [10, 10, 10, 10]],
            ['id' => 'charts',       'orientation' => 'portrait',  'margins' => [10, 10, 5, 20]],
            ['id' => 'conclusion',   'orientation' => 'portrait',  'margins' => [10, 10, 5, 20]],
        ];

        $tempFiles = [];
        $pdf = new Fpdi();
        $sectionPageCounts = [];

        // Pass 1: Get page counts for all sections
        foreach ($sections as $index => $section) {
            $html = view('public-report', array_merge($data, [
                'is_pdf' => true,
                'target_section' => $section['id']
            ]))->render();

            $browsershot = \Spatie\Browsershot\Browsershot::html($html)
                ->format('A4')
                ->margins($section['margins'][0], $section['margins'][1], $section['margins'][2], $section['margins'][3])
                ->printBackground()
                ->noSandbox()
                ->windowSize(1920, 1080)
                ->waitUntilNetworkIdle();

            if ($section['orientation'] === 'landscape') {
                $browsershot->landscape();
            }

            if ($section['id'] === 'charts') {
                $browsershot->delay(8000);
            }

            if ($chromePath = env('BROWSERSHOT_CHROME_PATH')) {
                $browsershot->setChromePath($chromePath);
            }
            if ($nodeBinary = env('BROWSERSHOT_NODE_BINARY')) {
                $browsershot->setNodeBinary($nodeBinary);
            }

            $tempPath = storage_path("app/count_{$uuid}_{$index}.pdf");
            $browsershot->save($tempPath);

            $tempPdf = new Fpdi();
            $sectionPageCounts[$section['id']] = $tempPdf->setSourceFile($tempPath);
            @unlink($tempPath);
        }

        // Calculate Start Pages
        $startPages = [];
        $current = 1;
        foreach ($sections as $section) {
            if ($section['id'] === 'cover') {
                $startPages[$section['id']] = 0;
                continue;
            }
            $startPages[$section['id']] = $current;
            $current += $sectionPageCounts[$section['id']];
        }

        $globalPageNumber = 1;

        foreach ($sections as $index => $section) {
            $html = view('public-report', array_merge($data, [
                'is_pdf' => true,
                'target_section' => $section['id'],
                'tocPages' => $startPages
            ]))->render();

            $browsershot = \Spatie\Browsershot\Browsershot::html($html)
                ->format('A4')
                ->margins($section['margins'][0], $section['margins'][1], $section['margins'][2], $section['margins'][3])
                ->printBackground()
                ->timeout(600)
                ->noSandbox()
                ->windowSize(1920, 1080)
                ->waitUntilNetworkIdle();

            if ($section['orientation'] === 'landscape') {
                $browsershot->landscape();
            }

            if ($section['id'] === 'charts') {
                $browsershot->delay(8000);
            }

            if ($chromePath = env('BROWSERSHOT_CHROME_PATH')) {
                $browsershot->setChromePath($chromePath);
            }

            if ($nodeBinary = env('BROWSERSHOT_NODE_BINARY')) {
                $browsershot->setNodeBinary($nodeBinary);
            }

            $tempPath = storage_path("app/report_{$uuid}_{$index}.pdf");
            $browsershot->save($tempPath);
            $tempFiles[] = $tempPath;

            $pageCount = $pdf->setSourceFile($tempPath);
            for ($i = 1; $i <= $pageCount; $i++) {
                $tplIdx = $pdf->importPage($i);
                $pdf->AddPage($section['orientation'] === 'landscape' ? 'L' : 'P', 'A4');
                $pdf->useTemplate($tplIdx, 0, 0, null, null, true);

                // Dynamic Page Numbering
                if ($section['id'] !== 'cover') {
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->SetTextColor(0, 0, 0);

                    $x = $pdf->GetPageWidth() - 10; // 1cm from right edge
                    $y = $pdf->GetPageHeight() - 5; // 0.5cm from bottom edge

                    // Draw text. Note: $pdf->Text uses baselines, adjust slightly for height
                    $pdf->Text($x - $pdf->GetStringWidth((string)$globalPageNumber), $y - 3, (string)$globalPageNumber);

                    $globalPageNumber++;
                }
            }
        }

        // Output PDF to browser
        $output = $pdf->Output('S');

        // Clean up temp files
        foreach ($tempFiles as $file) {
            if (file_exists($file)) @unlink($file);
        }

        return response($output)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Laporan-Psikologi-Kerja.pdf"');
    }

    private function getReportData($uuid)
    {
        $session = SurveySession::where('uuid', $uuid)->firstOrFail();

        // Load responses with answers and related question categories
        $session->load(['responses.answers.question']);

        $responses = $session->responses;
        $categories = QuestionCategory::all();

        // Prepare data for tables and charts
        $results = [];
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

        $monthYear = Carbon::parse($session->created_at)->locale('id')->translatedFormat('F Y');
        $dateFormatted = Carbon::parse($session->created_at)->locale('id')->translatedFormat('d F Y');

        $departments = $responses->pluck('department')->unique()->filter()->values();
        $departmentName = $departments->count() == 1 ? $departments[0] : ($departments->count() > 1 ? 'Berbagai Departemen' : 'Tidak Disebutkan');

        $globalSigners = \App\Models\Signer::all()->keyBy('type');

        return compact(
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
        );
    }
}
