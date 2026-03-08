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


<h3 class="text-xl font-bold mb-4 mt-8" id="hasil_pembahasan">6. Hasil dan Pembahasan</h3>
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