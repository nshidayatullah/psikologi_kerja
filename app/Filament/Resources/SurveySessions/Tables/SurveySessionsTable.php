<?php

namespace App\Filament\Resources\SurveySessions\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Support\Colors\Color;
use Filament\Notifications\Notification;
use App\Models\SurveySession;

class SurveySessionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Sesi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('responses_count')
                    ->label('Jumlah Responden')
                    ->counts('responses')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    Action::make('survey_link')
                        ->label('Link Survey')
                        ->icon('heroicon-o-link')
                        ->color(Color::Blue)
                        ->url(fn(SurveySession $record) => route('survey.show', $record->uuid))
                        ->openUrlInNewTab(),
                    Action::make('preview_report')
                        ->label('Pratinjau Laporan')
                        ->icon('heroicon-o-document-magnifying-glass')
                        ->color(Color::Emerald)
                        ->url(fn(SurveySession $record) => route('report.preview', $record->uuid))
                        ->openUrlInNewTab(),
                    Action::make('download_pdf')
                        ->label('Download PDF')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color(Color::Rose)
                        ->url(fn(SurveySession $record) => route('report.download', $record->uuid))
                        ->openUrlInNewTab(),

                    Action::make('sign_pic1')
                        ->label('Copy Link TTD PIC 1')
                        ->icon('heroicon-o-clipboard-document')
                        ->color(Color::Amber)
                        ->action(function (SurveySession $record, $livewire) {
                            $url = route('public.sign', ['uuid' => $record->uuid, 'type' => 'pic1']);
                            $livewire->js("window.navigator.clipboard.writeText('{$url}')");
                            Notification::make()
                                ->title('Link TTD PIC 1 disalin ke clipboard')
                                ->success()
                                ->send();
                        }),

                    Action::make('sign_pic2')
                        ->label('Copy Link TTD PIC 2')
                        ->icon('heroicon-o-clipboard-document')
                        ->color(Color::Amber)
                        ->action(function (SurveySession $record, $livewire) {
                            $url = route('public.sign', ['uuid' => $record->uuid, 'type' => 'pic2']);
                            $livewire->js("window.navigator.clipboard.writeText('{$url}')");
                            Notification::make()
                                ->title('Link TTD PIC 2 disalin ke clipboard')
                                ->success()
                                ->send();
                        }),

                    Action::make('sign_reviewer')
                        ->label('Copy Link TTD Dokter')
                        ->icon('heroicon-o-clipboard-document')
                        ->color(Color::Amber)
                        ->action(function (SurveySession $record, $livewire) {
                            $url = route('public.sign', ['uuid' => $record->uuid, 'type' => 'reviewer']);
                            $livewire->js("window.navigator.clipboard.writeText('{$url}')");
                            Notification::make()
                                ->title('Link TTD Dokter disalin ke clipboard')
                                ->success()
                                ->send();
                        }),

                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
