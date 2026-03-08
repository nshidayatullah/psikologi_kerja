<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\PublicSurveyForm;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/surveys/{uuid}', PublicSurveyForm::class)->name('survey.show');
Route::get('/reports/{uuid}', [ReportController::class, 'show'])->name('report.preview');
Route::get('/reports/{uuid}/download', [ReportController::class, 'download'])->name('report.download');
Route::get('/sign/{uuid}/{type}', \App\Livewire\PublicSignatureForm::class)->name('public.sign');

Route::get('/preview', [App\Http\Controllers\PreviewController::class, 'index'])->name('partial.index');
Route::get('/preview/{section}', [App\Http\Controllers\PreviewController::class, 'show'])->name('partial.preview');
