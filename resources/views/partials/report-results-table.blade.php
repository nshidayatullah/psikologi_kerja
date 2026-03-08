<h3 class="text-xl font-bold mb-4">6. Hasil</h3>
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
<div class="overflow-x-prevent-print">
    <table class="w-full border-collapse border border-gray-400 text-xs text-center mb-8">
        <thead class="bg-gray-100 font-bold uppercase">
            <tr>
                <th class="border border-gray-400 p-2" rowspan="2">NO</th>
                <th class="border border-gray-400 p-2" rowspan="2">NAMA RESPONDEN</th>
                <th class="border border-gray-400 p-2" rowspan="2">POSISI</th>
                <th class="border border-gray-400 p-2" colspan="{{ count($categories) }}">SKOR</th>
                <th class="border border-gray-400 p-2" rowspan="2">HASIL ANALISA</th>
            </tr>
            <tr>
                @foreach($categories as $cat)
                <th class="border border-gray-400 p-1">
                    <div class="vertical-text mx-auto">{{ $cat->name }}</div>
                </th>
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
</div>