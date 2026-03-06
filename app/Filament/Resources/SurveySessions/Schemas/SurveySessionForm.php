<?php

namespace App\Filament\Resources\SurveySessions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SurveySessionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Main fields
                Section::make('Informasi Sesi')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Sesi')
                            ->required(),
                        TextInput::make('uuid')
                            ->label('UUID (Otomatis)')
                            ->disabled()
                            ->dehydrated(false),
                        Toggle::make('is_active')
                            ->label('Aktif?')
                            ->default(true)
                            ->required(),
                    ]),

                // PIC Section (sidebar-style columns)
                Section::make('Penyusun & Pemeriksa Laporan')
                    ->description('Nama dan jabatan yang akan muncul di Lembar Pengesahan laporan.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('pic1_name')
                            ->label('Nama PIC 1')
                            ->default(fn() => \App\Models\Signer::where('type', 'pic1')->first()?->name ?? 'M. Hidayatullah')
                            ->readOnly(),
                        TextInput::make('pic2_name')
                            ->label('Nama PIC 2')
                            ->placeholder(fn() => \App\Models\Signer::where('type', 'pic2')->first()?->name ?? 'Nama PIC 2'),
                        TextInput::make('reviewer_name')
                            ->label('Nama Pemeriksa')
                            ->placeholder(fn() => \App\Models\Signer::where('type', 'reviewer')->first()?->name ?? 'Nama Dokter'),
                        TextInput::make('reviewer_role')
                            ->label('Jabatan Pemeriksa')
                            ->placeholder(fn() => \App\Models\Signer::where('type', 'reviewer')->first()?->role ?? 'Dokter Perusahaan'),
                    ]),

                // Rich text recommendations
                Section::make('Saran dan Rekomendasi')
                    ->schema([
                        RichEditor::make('recommendations')
                            ->label('Isi Saran dan Rekomendasi')
                            ->helperText('Isi akan ditampilkan di bagian "9. Saran dan Rekomendasi" pada Laporan.')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'orderedList', 'bulletList', 'h2', 'h3'])
                            ->columnSpanFull(),
                    ]),

                Section::make('Rencana Tindak Lanjut')
                    ->schema([
                        RichEditor::make('follow_up_plan')
                            ->label('Isi Rencana Tindak Lanjut')
                            ->helperText('Isi akan ditampilkan di bagian "10.c. Rencana Tindak Lanjut" pada Laporan.')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'orderedList', 'bulletList', 'h2', 'h3'])
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
