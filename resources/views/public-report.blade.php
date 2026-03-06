<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pengelolaan Psikologi Kerja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            body {
                background: white;
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .no-print {
                display: none;
            }

            .page-break {
                page-break-before: always;
            }
        }

        .a4-page {
            max-width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: white;
            padding: 20mm 20mm 30mm 20mm;
            /* Added more bottom padding for footer */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            /* For absolute positioning of footer */
        }

        .page-footer {
            position: absolute;
            bottom: 15mm;
            right: 20mm;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 font-sans antialiased pb-12">

    <!-- Navbar / Print Button -->
    <div class="no-print bg-white shadow-sm p-4 text-center mb-8 sticky top-0 z-50">
        <p class="text-gray-500 text-sm mb-2">Silakan gunakan tombol cetak di bawah ini untuk menyimpan Laporan Pengelolaan Psikologi Kerja sebagai PDF berukuran A4.</p>
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Cetak Laporan (PDF)
        </button>
    </div>

    <!-- Cover Page -->
    <div class="a4-page mb-8 relative page-break flex flex-col items-center justify-center" style="min-height: 297mm;">
        <div class="text-center">
            <h1 class="text-3xl font-bold uppercase mb-2">Laporan Penilaian</h1>
            <h1 class="text-3xl font-bold uppercase mb-8">Psikologi Kerja</h1>
            <h2 class="text-xl font-semibold uppercase mb-2">Bulan {{ $monthYear }}</h2>
            <h2 class="text-lg uppercase">PT. Putra Perkasa Abadi</h2>
            <h2 class="text-lg uppercase">Site PT. Borneo Indobara</h2>
        </div>
    </div>

    <!-- Page 1: Lembar Pengesahan -->
    <div class="a4-page mb-8 relative page-break">
        <div class="mb-8">
            <h3 class="text-xl font-bold mb-4" id="pengesahan">1. Lembar Pengesahan</h3>
            <p class="text-justify indent-8 leading-relaxed mb-8">
                Laporan ini disusun berdasarkan penilaian psikologi kerja pada PT. Putra Perkasa Abadi Site PT. Borneo Indobara yang dilaksanakan pada {{ $monthYear }} dengan harapan dapat meningkatkan derajat kesehatan tenaga kerja khususnya kesehatan dalam aspek psikologi serta mengimplementasikan upaya kesehatan pekerja sesuai perundangan yang berlaku.
            </p>
            <div class="mb-12">
                <p><strong>Diterbitkan di :</strong> Hati'if</p>
                <p><strong>Tanggal Terbit :</strong> {{ $dateFormatted }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 text-center mt-12 mb-8">
                <div class="col-span-2 text-center mb-0">
                    <p class="mb-4">Penyusun :</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="h-20 flex items-center justify-center">
                        @if($session->pic1_signature)
                        <img src="{{ $session->pic1_signature }}" class="max-h-20" alt="Signature PIC 1">
                        @endif
                    </div>
                    <p class="font-bold underline mt-2">{{ $session->pic1_name ?: ($globalSigners['pic1']->name ?? 'M. Hidayatullah') }}</p>
                    <p>{{ $globalSigners['pic1']->role ?? 'Paramedic' }}</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="h-20 flex items-center justify-center">
                        @if($session->pic2_signature)
                        <img src="{{ $session->pic2_signature }}" class="max-h-20" alt="Signature PIC 2">
                        @endif
                    </div>
                    <p class="font-bold underline mt-2">{{ $session->pic2_name ?: ($globalSigners['pic2']->name ?? 'Junardi') }}</p>
                    <p>{{ $globalSigners['pic2']->role ?? 'Paramedic' }}</p>
                </div>
            </div>

            <div class="flex flex-col items-center mt-8">
                <p class="mb-4">Diperiksa :</p>
                <div class="h-20 flex items-center justify-center">
                    @if($session->reviewer_signature)
                    <img src="{{ $session->reviewer_signature }}" class="max-h-20" alt="Signature Reviewer">
                    @endif
                </div>
                <p class="font-bold underline mt-2">{{ $session->reviewer_name ?: ($globalSigners['reviewer']->name ?? 'dr. Haamim Sajdah S') }}</p>
                <p>{{ $session->reviewer_role ?: ($globalSigners['reviewer']->role ?? 'Dokter Perusahaan') }}</p>
            </div>
        </div>

        <div class="page-footer">1</div>
    </div>

    <!-- Page 3: Daftar Isi & Pendahuluan -->
    <div class="a4-page mb-8 page-break">
        <h3 class="text-xl font-bold mb-4" id="daftar_isi">2. Daftar Isi</h3>
        <ul class="space-y-2 mb-12 list-none leading-relaxed">
            <li class="flex justify-between"><a href="#pengesahan" class="hover:underline">1. Lembar Pengesahan</a><span>1</span></li>
            <li class="flex justify-between"><a href="#daftar_isi" class="hover:underline">2. Daftar Isi</a><span>2</span></li>
            <li class="flex justify-between"><a href="#pendahuluan" class="hover:underline">3. Pendahuluan</a><span>2</span></li>
            <li class="flex justify-between"><a href="#tujuan" class="hover:underline">4. Tujuan</a><span>2</span></li>
            <li class="flex justify-between"><a href="#metode" class="hover:underline">5. Metode</a><span>3</span></li>
            <li class="flex justify-between"><a href="#hasil_pembahasan" class="hover:underline">6. Hasil dan Pembahasan</a><span>4</span></li>
            <li class="flex justify-between"><a href="#hasil" class="hover:underline">7. Hasil</a><span>4</span></li>
            <li class="flex justify-between"><a href="#simpulan" class="hover:underline">8. Simpulan</a><span>5</span></li>
            <li class="flex justify-between"><a href="#saran" class="hover:underline">9. Saran dan rekomendasi</a><span>5</span></li>
            <li class="flex justify-between"><a href="#evaluasi" class="hover:underline">10. Evaluasi</a><span>5</span></li>
        </ul>

        <h3 class="text-xl font-bold mb-4" id="pendahuluan">3. Pendahuluan</h3>
        <p class="text-justify indent-8 leading-relaxed mb-4">
            Berdasarkan Permenaker No. 5 Tahun 2018, setiap pelaku usaha diwajibkan untuk melakukan penilaian stres kerja di lingkungan kerjanya, sebagai bagian dari penerapan system manajemen Keselamatan dan Kesehatan Kerja (K3).
        </p>
        <p class="text-justify indent-8 leading-relaxed mb-4">
            Stres adalah respon adaptif melalui karakteristik individu atau proses psikologis secara langsung terhadap tindakan, situasi dan kejadian eksternal yang menimbulkan tuntutan khusus baik fisik maupun psikologis individu yang bersangkutan.
        </p>

        <h3 class="text-xl font-bold mb-4 mt-8" id="tujuan">4. Tujuan</h3>
        <p class="text-justify indent-8 leading-relaxed mb-4">
            Tujuan umum dari penilaian stress kerja adalah untuk mengetahui tingkat stress kerja serta untuk memberikan rekomendasi tindak lanjut atas temuan stress kerja karyawan PT. Putra Perkasa Abadi site PT. Borneo Indobara.
        </p>

        <div class="page-footer">2</div>
    </div>

    <!-- Page 4: Metode -->
    <div class="a4-page mb-8 page-break">
        <h3 class="text-xl font-bold mb-4" id="metode">5. Metode</h3>
        <p class="text-justify indent-8 leading-relaxed mb-4">
            Pengukuran stress kerja PT. Putra Perkasa Abadi site PT. Borneo Indobara menggunakan kuesioner SDS (Survei Diagnosis Stres) yang merupakan alat ukur stres yang dikembangkan oleh Badan Penelitian dan Pengembangan Departemen Kesehatan RI.Kuesioner SDS terdiri dari 30 pertanyaan yang mencakup macam-macam sumber stressor kerja,yaitu:
        </p>
        <ul class="list-disc pl-8 mb-4 space-y-2 text-justify">
            <li><strong>Ketaksaan Peran (KP):</strong> Sasaran yang tidak jelas mengarah pada ketidakpuasan kerja.</li>
            <li><strong>Konflik Peran (KOP):</strong> Keadaan dimana terdapat tugas yang sama pada dua atau lebih individu.</li>
            <li><strong>Beban Kerja Berlebih Kuantitatif:</strong> Jumlah atau banyaknya pekerjaan yang harus ditanggung oleh individu.</li>
            <li><strong>Beban Kerja Berlebih Kualitatif:</strong> Pekerjaan yang harus ditanggung oleh individu berdasarkan kualitas.</li>
            <li><strong>Pengembangan Karir:</strong> Proses peningkatan kemampuan kerja individu.</li>
            <li><strong>Tanggung Jawab Terhadap Orang Lain:</strong> Kewajiban yang berhubungan dengan orang lain.</li>
        </ul>

        <div class="page-footer">3</div>
    </div>

    <!-- Page 5: Hasil & Pembahasan -->
    <div class="a4-page mb-8 page-break">
        <h3 class="text-xl font-bold mb-4" id="hasil_pembahasan">6. Hasil dan Pembahasan</h3>
        <p class="text-justify indent-8 leading-relaxed mb-6">
            Penilaian stres kerja dilakukan lokasi kerja PT. Putra Perkasa Abadi Site PT. Borneo Indobara yaitu di area {{ $departmentName }} dengan mengambil sampel sebanyak {{ $totalParticipants }} responden, survey dilakukan pada {{ $monthYear }}.
        </p>

        <table class="w-[70%] mx-auto mb-10 border-collapse border border-gray-400">
            <tbody>
                <tr>
                    <td class="border border-gray-400 p-2 font-bold bg-gray-50 w-1/2">Periode</td>
                    <td class="border border-gray-400 p-2">{{ $monthYear }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-2 font-bold bg-gray-50">Tanggal Pelaksanaan</td>
                    <td class="border border-gray-400 p-2">{{ $dateFormatted }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-2 font-bold bg-gray-50">Lokasi</td>
                    <td class="border border-gray-400 p-2">{{ $departmentName }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-2 font-bold bg-gray-50">Jumlah Peserta</td>
                    <td class="border border-gray-400 p-2">{{ $totalParticipants }} Peserta</td>
                </tr>
            </tbody>
        </table>

        <h3 class="text-xl font-bold mb-4" id="hasil">7. Hasil</h3>
        <table class="text-sm mb-4 border-none">
            <tbody>
                <tr>
                    <td class="pr-4 font-bold align-top whitespace-nowrap">TANGGAL PENGUJIAN</td>
                    <td class="pr-2 align-top font-bold">:</td>
                    <td>{{ mb_strtoupper($dateFormatted) }}</td>
                </tr>
                <tr>
                    <td class="pr-4 font-bold align-top whitespace-nowrap">PARAMETER UJI</td>
                    <td class="pr-2 align-top font-bold">:</td>
                    <td>PEMERIKSAAN FAKTOR PSIKOLOGI KERJA</td>
                </tr>
                <tr>
                    <td class="pr-4 font-bold align-top whitespace-nowrap">METODA PENGUJIAN</td>
                    <td class="pr-2 align-top font-bold">:</td>
                    <td>SURVEI DIAGNOSIS STRESS KERJA</td>
                </tr>
                <tr>
                    <td class="pr-4 font-bold align-top whitespace-nowrap">ALAT UKUR</td>
                    <td class="pr-2 align-top font-bold">:</td>
                    <td>KUISIONER SDS 30</td>
                </tr>
            </tbody>
        </table>

        <!-- Dynamic Table -->
        <table class="w-full border-collapse border border-gray-400 text-xs text-center mb-8">
            <thead class="bg-gray-100 font-bold">
                <tr>
                    <th class="border border-gray-400 p-2" rowspan="2">NO</th>
                    <th class="border border-gray-400 p-2" rowspan="2">NAMA RESPONDEN</th>
                    <th class="border border-gray-400 p-2" rowspan="2">POSISI</th>
                    <th class="border border-gray-400 p-2" colspan="{{ count($categories) }}">SKOR</th>
                    <th class="border border-gray-400 p-2" rowspan="2">HASIL ANALISA</th>
                </tr>
                <tr>
                    @foreach($categories as $cat)
                    <!-- Mapping dimensions strictly to short format inside table if possible, fallback to initials -->
                    @php
                    $shortName = match($cat->name) {
                    'Ketaksaan Peran' => 'KP',
                    'Konflik Peran' => 'KOP',
                    'Beban Berlebih Kuantitatif' => 'BB-KUAN',
                    'Beban Kualitatif' => 'BB-KUAL',
                    'Pengembangan Karir' => 'PK',
                    'Tanggung jawab thd orang lain' => 'TJ',
                    default => substr($cat->name, 0, 3)
                    };
                    @endphp
                    <th class="border border-gray-400 p-1">{{ $shortName }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($results as $index => $row)
                <tr>
                    <td class="border border-gray-400 p-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-400 p-2">{{ mb_strtoupper($row['name']) }}</td>
                    <td class="border border-gray-400 p-2">{{ mb_strtoupper($row['position']) }}</td>
                    @foreach($categories as $cat)
                    <td class="border border-gray-400 p-1">{{ $row['scores'][$cat->id] }}</td>
                    @endforeach
                    <td class="border border-gray-400 p-2 text-left">{{ $row['analisa_text'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ count($categories) + 4 }}" class="border border-gray-400 p-4 text-gray-500 italic">Belum ada data partisipan untuk sesi ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Chart Section -->
        <h3 class="text-xl font-bold mb-4 page-break">Rangkuman Distribusi Tingkat Stres</h3>
        <div class="mb-4 w-[90%] mx-auto" style="height: 350px;">
            <canvas id="stressChart"></canvas>
        </div>
        <script id="chartDataPayload" type="application/json">
            @json($chartData)
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Chart.register(ChartDataLabels);
                const ctx = document.getElementById('stressChart').getContext('2d');

                // Injecting dynamic data from backend
                const rawData = JSON.parse(document.getElementById('chartDataPayload').textContent);
                const labels = rawData.labels;
                const dataRingan = rawData.datasets.RINGAN;
                const dataSedang = rawData.datasets.SEDANG;
                const dataBerat = rawData.datasets.BERAT;

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'STRESS RINGAN',
                                data: dataRingan,
                                backgroundColor: 'rgba(34, 197, 94, 0.8)', // Green
                                borderWidth: 1
                            },
                            {
                                label: 'STRESS SEDANG',
                                data: dataSedang,
                                backgroundColor: 'rgba(234, 179, 8, 0.8)', // Yellow
                                borderWidth: 1
                            },
                            {
                                label: 'STRESS BERAT',
                                data: dataBerat,
                                backgroundColor: 'rgba(239, 68, 68, 0.8)', // Red
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 70, // Adjust based on max respondents
                                title: {
                                    display: true,
                                    text: 'Jumlah Responden'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            datalabels: {
                                color: '#333',
                                anchor: 'end',
                                align: 'top',
                                font: {
                                    weight: 'bold'
                                },
                                formatter: function(value, context) {
                                    if (value === 0) return '';
                                    return value;
                                }
                            }
                        }
                    }
                });
            });
        </script>

        <!-- Percentage Chart Section -->
        <h3 class="text-xl font-bold mb-4 mt-8">Rangkuman Distribusi Tingkat Stres (%)</h3>
        <div class="mb-4 w-[90%] mx-auto" style="height: 350px;">
            <canvas id="stressChartPct"></canvas>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctxPct = document.getElementById('stressChartPct').getContext('2d');
                const rawData = JSON.parse(document.getElementById('chartDataPayload').textContent);
                const labels = rawData.labels;
                const pctRingan = rawData.percentages.RINGAN;
                const pctSedang = rawData.percentages.SEDANG;
                const pctBerat = rawData.percentages.BERAT;

                new Chart(ctxPct, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'STRESS RINGAN',
                                data: pctRingan,
                                backgroundColor: 'rgba(34, 197, 94, 0.8)',
                                borderWidth: 1
                            },
                            {
                                label: 'STRESS SEDANG',
                                data: pctSedang,
                                backgroundColor: 'rgba(234, 179, 8, 0.8)',
                                borderWidth: 1
                            },
                            {
                                label: 'STRESS BERAT',
                                data: pctBerat,
                                backgroundColor: 'rgba(239, 68, 68, 0.8)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                title: {
                                    display: true,
                                    text: 'Persentase (%)'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            datalabels: {
                                color: '#333',
                                anchor: 'end',
                                align: 'top',
                                font: {
                                    weight: 'bold'
                                },
                                formatter: function(value) {
                                    if (value === 0) return '';
                                    return value + '%';
                                }
                            }
                        }
                    }
                });
            });
        </script>

        <div class="page-footer">4</div>
    </div>

    <!-- Page 6: Simpulan & Saran -->
    <div class="a4-page mb-8 page-break">
        <h3 class="text-xl font-bold mb-4" id="simpulan">8. Simpulan</h3>
        <p class="text-justify leading-relaxed mb-4">
            Berdasarkan pemeriksaan psikologi pada {{ $totalParticipants }} orang pekerja didapatkan hasil sebagai berikut:
        </p>
        <ul class="list-decimal pl-6 space-y-2 mb-6 text-justify">
            @foreach($categories as $cat)
            <li><strong>{{ $cat->name }}:</strong> Tingkat persentase resiko Stres SEDANG berjumlah {{ $percentages[$cat->id]['SEDANG'] }}%, Stres BERAT sebesar {{ $percentages[$cat->id]['BERAT'] }}%, sedangkan Stres RINGAN {{ $percentages[$cat->id]['RINGAN'] }}%.</li>
            @endforeach
        </ul>

        <h3 class="text-xl font-bold mb-4 mt-8" id="saran">9. Saran dan Rekomendasi</h3>
        @if($session->recommendations)
        <div class="prose prose-sm max-w-none text-justify mb-6">
            {!! $session->recommendations !!}
        </div>
        @else
        <ol class="list-decimal pl-6 space-y-2 mb-6 text-justify">
            <li>Membuat dan menjelaskan job description yang jelas.</li>
            <li>Mengadakan kegiatan untuk meningkatkan komunikasi dan koordinasi di antara karyawan dan pimpinan.</li>
            <li>Mengatur jumlah beban kerja yang diberikan kepada pegawai serta menyesuaikan dengan kemampuan fisik dan mental.</li>
            <li>Mengadakan pelatihan manajemen stress.</li>
        </ol>
        @endif

        <h3 class="text-xl font-bold mb-4 mt-8" id="evaluasi">10. Evaluasi</h3>
        <div class="space-y-4 text-justify">
            <p><strong>a. Keberhasilan:</strong> Pelaksanaan penggukuran stress kerja internal telah dilakukan pada bulan {{ $monthYear }} di area {{ $departmentName }} dengan jumlah peserta {{ $totalParticipants }} Peserta.</p>
            <p><strong>b. Kendala:</strong> -</p>
            <p><strong>c. Rencana Tindak Lanjut:</strong>
                @if($session->follow_up_plan)
                {!! $session->follow_up_plan !!}
                @else
                Dilakukan pemanggilan karyawan untuk di berikan konseling / edukasi terkait kesehatan mental kerja.
                @endif
            </p>
            <p><strong>d. Penutup:</strong> Demikian laporan stress kerja bulanan ini dibuat. Diharapkan laporan ini dapat bermanfaat untuk meningkatkan kesehatan mental pekerja di tempat kerja.</p>
        </div>

        <div class="page-footer">5</div>
    </div>

</body>

</html>
