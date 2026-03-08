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
                            ->hidden()
                            ->dehydrated(false),
                        Toggle::make('is_active')
                            ->label('Aktif?')
                            ->default(true)
                            ->required(),
                    ])
                    ->columnSpanFull(),

                // PIC Section (sidebar-style columns)
                Section::make('Pejabat Penandatangan')
                    ->description('Nama dan jabatan yang akan muncul di Lembar Pengesahan laporan. Data default diambil dari menu Signers.')
                    ->schema([
                        \Filament\Schemas\Components\Fieldset::make('PIC 1 (Sisi Kiri)')
                            ->schema([
                                TextInput::make('pic1_name')
                                    ->label('Nama Lengkap')
                                    ->placeholder(fn() => \App\Models\Signer::where('type', 'pic1')->first()?->name)
                                    ->hint('Kosongkan untuk menggunakan data global admin'),
                                TextInput::make('pic1_role')
                                    ->label('Jabatan / Gelar')
                                    ->placeholder(fn() => \App\Models\Signer::where('type', 'pic1')->first()?->role)
                                    ->hint('Kosongkan untuk menggunakan data global admin'),
                            ])->columnSpan(1),

                        \Filament\Schemas\Components\Fieldset::make('PIC 2 (Sisi Kanan)')
                            ->schema([
                                TextInput::make('pic2_name')
                                    ->label('Nama Lengkap')
                                    ->placeholder(fn() => \App\Models\Signer::where('type', 'pic2')->first()?->name)
                                    ->hint('Kosongkan untuk menggunakan data global admin'),
                                TextInput::make('pic2_role')
                                    ->label('Jabatan / Gelar')
                                    ->placeholder(fn() => \App\Models\Signer::where('type', 'pic2')->first()?->role)
                                    ->hint('Kosongkan untuk menggunakan data global admin'),
                            ])->columnSpan(1),

                        \Filament\Schemas\Components\Fieldset::make('Dokter Pemeriksa (Tengah)')
                            ->schema([
                                TextInput::make('reviewer_name')
                                    ->label('Nama Lengkap')
                                    ->placeholder(fn() => \App\Models\Signer::where('type', 'reviewer')->first()?->name)
                                    ->hint('Kosongkan untuk menggunakan data global admin'),
                                TextInput::make('reviewer_role')
                                    ->label('Jabatan / Gelar')
                                    ->placeholder(fn() => \App\Models\Signer::where('type', 'reviewer')->first()?->role)
                                    ->hint('Kosongkan untuk menggunakan data global admin'),
                            ])->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->hidden(),

                // Rich text recommendations
                Section::make('Saran dan Rekomendasi')
                    ->schema([
                        RichEditor::make('recommendations')
                            ->label('Isi Saran dan Rekomendasi')
                            ->helperText('Isi akan ditampilkan di bagian "8. Saran dan Rekomendasi" pada Laporan.')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'orderedList', 'bulletList', 'h2', 'h3'])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Section::make('Rencana Tindak Lanjut')
                    ->schema([
                        RichEditor::make('follow_up_plan')
                            ->label('Isi Rencana Tindak Lanjut')
                            ->helperText('Isi akan ditampilkan di bagian "9.c. Rencana Tindak Lanjut" pada Laporan.')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'orderedList', 'bulletList', 'h2', 'h3'])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
