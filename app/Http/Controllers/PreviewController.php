<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PreviewController extends Controller
{
    public function index()
    {
        $partials = collect([
            'report-cover',
            'report-approval',
            'report-introduction',
            'report-methodology',
            'report-results-table',
            'report-results-charts',
            'report-conclusion',
        ]);

        return view('preview-dashboard', compact('partials'));
    }

    public function show($section)
    {
        $mockData = $this->getMockData();

        // Map common variable names used in partials
        $data = array_merge($mockData, [
            'section' => $section,
            'is_pdf' => false,
        ]);

        return view('section-preview', $data);
    }

    private function getMockData()
    {
        $monthYear = Carbon::now()->translatedFormat('F Y');
        $dateFormatted = Carbon::now()->translatedFormat('d F Y');

        $categories = collect([
            (object)['id' => 1, 'name' => 'Ketaksaan Peran'],
            (object)['id' => 2, 'name' => 'Konflik Peran'],
            (object)['id' => 3, 'name' => 'Beban Berlebih Kuantitatif'],
            (object)['id' => 4, 'name' => 'Beban Kualitatif'],
            (object)['id' => 5, 'name' => 'Pengembangan Karir'],
            (object)['id' => 6, 'name' => 'Tanggung jawab thd orang lain'],
        ]);

        $results = [];
        for ($i = 1; $i <= 5; $i++) {
            $results[] = [
                'name' => "KARYAWAN DEMO $i",
                'position' => "POSITION $i",
                'scores' => [1 => 15, 2 => 8, 3 => 22, 4 => 12, 5 => 5, 6 => 18],
                'analisa_text' => "Tingkat risiko stres SEDANG pada stresor ketaksaan peran. Tingkat risiko stres RINGAN pada stresor konflik peran."
            ];
        }

        $chartData = [
            'labels' => $categories->pluck('name')->toArray(),
            'datasets' => [
                'RINGAN' => [10, 15, 5, 20, 25, 10],
                'SEDANG' => [30, 25, 40, 20, 15, 35],
                'BERAT' => [10, 10, 5, 10, 10, 5]
            ],
            'percentages' => [
                'RINGAN' => [20, 30, 10, 40, 50, 20],
                'SEDANG' => [60, 50, 80, 40, 30, 70],
                'BERAT' => [20, 20, 10, 20, 20, 10]
            ]
        ];

        $percentages = [];
        foreach ($categories as $cat) {
            $percentages[$cat->id] = ['RINGAN' => 20, 'SEDANG' => 60, 'BERAT' => 20];
        }

        return [
            'monthYear' => $monthYear,
            'dateFormatted' => $dateFormatted,
            'departmentName' => 'OPERATIONAL DEMO',
            'totalParticipants' => 50,
            'categories' => $categories,
            'results' => $results,
            'chartData' => $chartData,
            'percentages' => $percentages,
            'session' => (object)[
                'recommendations' => '<p>1. Demo recommendation item one.<br>2. Demo recommendation item two.</p>',
                'follow_up_plan' => 'Demo follow up plan text content.',
                'pic1_name' => 'Demo PIC 1',
                'pic1_role' => 'Safety Officer',
                'pic2_name' => 'Demo PIC 2',
                'pic2_role' => 'Paramedic',
                'reviewer_name' => 'Demo Reviewer',
                'reviewer_role' => 'Project Manager',
                'pic1_signature' => null,
                'pic2_signature' => null,
                'reviewer_signature' => null,
            ],
            'globalSigners' => [
                'pic1' => (object)['name' => 'Global PIC 1', 'role' => 'Officer', 'signature' => null],
                'pic2' => (object)['name' => 'Global PIC 2', 'role' => 'Medic', 'signature' => null],
                'reviewer' => (object)['name' => 'Global Lead', 'role' => 'Lead', 'signature' => null],
            ]
        ];
    }
}
