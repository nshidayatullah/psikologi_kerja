<?php

namespace App\Filament\Resources\SurveyResponses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SurveyResponsesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('session.title')
                    ->label('Sesi Survei')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('batch')
                    ->label('Batch')
                    ->searchable(),
                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('company')
                    ->label('Perusahaan')
                    ->searchable(),
                TextColumn::make('department')
                    ->label('Departemen')
                    ->searchable(),
                TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama Pekerja')
                    ->searchable(),
                TextColumn::make('total_score')
                    ->label('Total Skor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('score_kp')
                    ->label('Ketaksaan Peran')
                    ->getStateUsing(function ($record) {
                        $score = $record->answers->filter(fn($a) => $a->question->question_category_id == 1)->sum('score');
                        $cat = $score <= 9 ? 'RINGAN' : ($score <= 24 ? 'SEDANG' : 'BERAT');
                        return $score . " ($cat)";
                    })
                    ->badge()
                    ->color(function ($record) {
                        $score = $record->answers->filter(fn($a) => $a->question->question_category_id == 1)->sum('score');
                        return $score <= 9 ? 'success' : ($score <= 24 ? 'warning' : 'danger');
                    })
                    ->toggleable(),
                TextColumn::make('score_kop')
                    ->label('Konflik Peran')
                    ->getStateUsing(function ($record) {
                        $score = $record->answers->filter(fn($a) => $a->question->question_category_id == 2)->sum('score');
                        $cat = $score <= 9 ? 'RINGAN' : ($score <= 24 ? 'SEDANG' : 'BERAT');
                        return $score . " ($cat)";
                    })
                    ->badge()
                    ->color(function ($record) {
                        $score = $record->answers->filter(fn($a) => $a->question->question_category_id == 2)->sum('score');
                        return $score <= 9 ? 'success' : ($score <= 24 ? 'warning' : 'danger');
                    })
                    ->toggleable(),
                TextColumn::make('score_bbkuan')
                    ->label('Beban Kuantitatif')
                    ->getStateUsing(function ($record) {
                        $score = $record->answers->filter(fn($a) => $a->question->question_category_id == 3)->sum('score');
                        $cat = $score <= 9 ? 'RINGAN' : ($score <= 24 ? 'SEDANG' : 'BERAT');
                        return $score . " ($cat)";
                    })
                    ->badge()
                    ->color(function ($record) {
                        $score = $record->answers->filter(fn($a) => $a->question->question_category_id == 3)->sum('score');
                        return $score <= 9 ? 'success' : ($score <= 24 ? 'warning' : 'danger');
                    })
                    ->toggleable(),
                TextColumn::make('score_bbkual')
                    ->label('Beban Kualitatif')
                    ->getStateUsing(function ($record) {
                        $score = $record->answers->filter(fn($a) => $a->question->question_category_id == 4)->sum('score');
                        $cat = $score <= 9 ? 'RINGAN' : ($score <= 24 ? 'SEDANG' : 'BERAT');
                        return $score . " ($cat)";
                    })
                    ->badge()
                    ->color(function ($record) {
                        $score = $record->answers->filter(fn($a) => $a->question->question_category_id == 4)->sum('score');
                        return $score <= 9 ? 'success' : ($score <= 24 ? 'warning' : 'danger');
                    })
                    ->toggleable(),
                TextColumn::make('score_pk')
                    ->label('Pengemb. Karir')
                    ->getStateUsing(function ($record) {
                        $score = $record->answers->filter(fn($a) => $a->question->question_category_id == 5)->sum('score');
                        $cat = $score <= 9 ? 'RINGAN' : ($score <= 24 ? 'SEDANG' : 'BERAT');
                        return $score . " ($cat)";
                    })
                    ->badge()
                    ->color(function ($record) {
                        $score = $record->answers->filter(fn($a) => $a->question->question_category_id == 5)->sum('score');
                        return $score <= 9 ? 'success' : ($score <= 24 ? 'warning' : 'danger');
                    })
                    ->toggleable(),
                TextColumn::make('score_tj')
                    ->label('Tanggung Jawab')
                    ->getStateUsing(function ($record) {
                        $score = $record->answers->filter(fn($a) => $a->question->question_category_id == 6)->sum('score');
                        $cat = $score <= 9 ? 'RINGAN' : ($score <= 24 ? 'SEDANG' : 'BERAT');
                        return $score . " ($cat)";
                    })
                    ->badge()
                    ->color(function ($record) {
                        $score = $record->answers->filter(fn($a) => $a->question->question_category_id == 6)->sum('score');
                        return $score <= 9 ? 'success' : ($score <= 24 ? 'warning' : 'danger');
                    })
                    ->toggleable(),
                TextColumn::make('kategori_stres')
                    ->label('Tingkat Stres')
                    ->getStateUsing(fn($record) => $record->total_score <= 54 ? 'Ringan' : ($record->total_score <= 144 ? 'Sedang' : 'Berat'))
                    ->badge()
                    ->color(fn($record) => $record->total_score <= 54 ? 'success' : ($record->total_score <= 144 ? 'warning' : 'danger'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
