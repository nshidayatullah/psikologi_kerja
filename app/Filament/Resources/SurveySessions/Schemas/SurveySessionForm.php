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

                // PIC Section
                Section::make('Pejabat Penandatangan')
                    ->description('Nama dan jabatan yang akan muncul di Lembar Pengesahan laporan. Jika dikosongkan, data default akan diambil dari pengaturan global.')
                    ->schema([
                        \Filament\Schemas\Components\Fieldset::make('PIC 1 (Sisi Kiri)')
                            ->schema([
                                \Filament\Forms\Components\Select::make('pic1_signer_select')
                                    ->label('Pilih PIC 1 Global')
                                    ->options(fn() => \App\Models\Signer::where('type', 'pic1')->pluck('name', 'id'))
                                    ->live()
                                    ->afterStateUpdated(function ($state, $set) {
                                        if ($signer = \App\Models\Signer::find($state)) {
                                            $set('pic1_name', $signer->name);
                                            $set('pic1_role', $signer->role);
                                        }
                                    })
                                    ->dehydrated(false),
                                TextInput::make('pic1_name')
                                    ->label('Nama Lengkap (Override)'),
                                TextInput::make('pic1_role')
                                    ->label('Jabatan / Gelar'),
                            ])->columnSpan(2),

                        \Filament\Schemas\Components\Fieldset::make('PIC 2 (Sisi Kanan)')
                            ->schema([
                                \Filament\Forms\Components\Select::make('pic2_signer_select')
                                    ->label('Pilih PIC 2 Global')
                                    ->options(fn() => \App\Models\Signer::where('type', 'pic2')->pluck('name', 'id'))
                                    ->live()
                                    ->afterStateUpdated(function ($state, $set) {
                                        if ($signer = \App\Models\Signer::find($state)) {
                                            $set('pic2_name', $signer->name);
                                            $set('pic2_role', $signer->role);
                                        }
                                    })
                                    ->dehydrated(false),
                                TextInput::make('pic2_name')
                                    ->label('Nama Lengkap (Override)'),
                                TextInput::make('pic2_role')
                                    ->label('Jabatan / Gelar'),
                            ])->columnSpan(2),

                        \Filament\Schemas\Components\Group::make()
                            ->columnSpan(1),
                        \Filament\Schemas\Components\Fieldset::make('Dokter Perusahaan (Tengah)')
                            ->schema([
                                \Filament\Forms\Components\Select::make('reviewer_signer_select')
                                    ->label('Pilih Dokter Global')
                                    ->options(fn() => \App\Models\Signer::where('type', 'reviewer')->pluck('name', 'id'))
                                    ->live()
                                    ->afterStateUpdated(function ($state, $set) {
                                        if ($signer = \App\Models\Signer::find($state)) {
                                            $set('reviewer_name', $signer->name);
                                            $set('reviewer_role', $signer->role);
                                        }
                                    })
                                    ->dehydrated(false),
                                TextInput::make('reviewer_name')
                                    ->label('Nama Lengkap (Override)'),
                                TextInput::make('reviewer_role')
                                    ->label('Jabatan / Gelar'),
                            ])->columnSpan(2),
                    ])
                    ->columns(4)
                    ->columnSpanFull(),

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
