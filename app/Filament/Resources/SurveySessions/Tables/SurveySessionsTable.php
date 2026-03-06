<?php

namespace App\Filament\Resources\SurveySessions\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SurveySessionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Sesi')
                    ->searchable(),
                TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Aktif?')
                    ->boolean(),
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
                ActionGroup::make([
                    Action::make('qr_code')
                        ->label('QR Code')
                        ->icon('heroicon-o-qr-code')
                        ->modalHeading(fn($record) => 'QR Code Link: ' . $record->title)
                        ->modalContent(fn($record) => new \Illuminate\Support\HtmlString('<div style="text-align: center; padding: 20px;">' . \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate(url('/surveys/' . $record->uuid)) . '<br><br><a href="' . url('/surveys/' . $record->uuid) . '" target="_blank" style="color: blue; text-decoration: underline;">Buka Link Kuesioner</a></div>'))
                        ->modalSubmitAction(false)
                        ->modalCancelAction(false),
                    Action::make('copy_link_pic1')
                        ->label('Copy Link PIC 1')
                        ->icon('heroicon-o-clipboard-document')
                        ->color('success')
                        ->extraAttributes(fn($record) => [
                            'onclick' => "navigator.clipboard.writeText('" . route('public.sign', ['uuid' => $record->uuid, 'type' => 'pic1']) . "').then(() => { new FilamentNotification().title('Link PIC 1 Berhasil Disalin').success().send(); })",
                        ]),
                    Action::make('copy_link_pic2')
                        ->label('Copy Link PIC 2')
                        ->icon('heroicon-o-clipboard-document')
                        ->color('success')
                        ->extraAttributes(fn($record) => [
                            'onclick' => "navigator.clipboard.writeText('" . route('public.sign', ['uuid' => $record->uuid, 'type' => 'pic2']) . "').then(() => { new FilamentNotification().title('Link PIC 2 Berhasil Disalin').success().send(); })",
                        ]),
                    Action::make('copy_link_reviewer')
                        ->label('Copy Link Dokter')
                        ->icon('heroicon-o-clipboard-document')
                        ->color('success')
                        ->extraAttributes(fn($record) => [
                            'onclick' => "navigator.clipboard.writeText('" . route('public.sign', ['uuid' => $record->uuid, 'type' => 'reviewer']) . "').then(() => { new FilamentNotification().title('Link Dokter Berhasil Disalin').success().send(); })",
                        ]),
                    Action::make('report')
                        ->label('Lihat Laporan')
                        ->icon('heroicon-o-document-chart-bar')
                        ->color('info')
                        ->url(fn($record) => route('report.preview', ['uuid' => $record->uuid]))
                        ->openUrlInNewTab(),
                    EditAction::make(),
                ])->icon('heroicon-m-ellipsis-vertical')
                    ->tooltip('Aksi')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
