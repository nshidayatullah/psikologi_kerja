<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\PublicSurveyForm;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/surveys/{uuid}', PublicSurveyForm::class)->name('survey.show');
Route::get('/reports/{uuid}', [ReportController::class, 'show'])->name('report.preview');
Route::get('/sign/{uuid}/{type}', \App\Livewire\PublicSignatureForm::class)->name('public.sign');
