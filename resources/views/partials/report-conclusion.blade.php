<h3 class="text-xl font-bold mb-4" id="simpulan">7. Simpulan</h3>
<p class="text-justify indent-8 leading-relaxed mb-4">
    Berdasarkan pemeriksaan psikologi pada {{ $totalParticipants }} orang pekerja didapatkan hasil sebagai berikut:
</p>
<ul class="list-decimal pl-8 space-y-2 mb-4 text-justify">
    @foreach($categories as $cat)
    <li><strong>{{ $cat->name }}:</strong> Tingkat persentase resiko Stres SEDANG berjumlah {{ $percentages[$cat->id]['SEDANG'] }}%, Stres BERAT sebesar {{ $percentages[$cat->id]['BERAT'] }}%, sedangkan Stres RINGAN {{ $percentages[$cat->id]['RINGAN'] }}%.</li>
    @endforeach
</ul>

<h3 class="text-xl font-bold mb-4" id="saran">8. Saran dan Rekomendasi</h3>
@if($session->recommendations)
<div class="rich-text text-justify mb-4">
    {!! $session->recommendations !!}
</div>
@else
<ol class="list-decimal pl-8 space-y-2 mb-4 text-justify">
    <li>Membuat dan menjelaskan job description yang jelas.</li>
    <li>Mengadakan kegiatan untuk meningkatkan komunikasi dan koordinasi di antara karyawan dan pimpinan.</li>
    <li>Mengatur jumlah beban kerja yang diberikan kepada pegawai serta menyesuaikan dengan kemampuan fisik dan mental.</li>
    <li>Mengadakan pelatihan manajemen stress.</li>
</ol>
@endif

<h3 class="text-xl font-bold mb-4" id="evaluasi">9. Evaluasi</h3>
<div class="space-y-4 text-justify mb-4">
    <p><strong>a. Keberhasilan:</strong> Pelaksanaan penggukuran stress kerja internal telah dilakukan pada bulan {{ $monthYear }} di area {{ $departmentName }} dengan jumlah peserta {{ $totalParticipants }} Peserta.</p>
    <p><strong>b. Kendala:</strong> -</p>
    <div class="mb-4">
        <strong>c. Rencana Tindak Lanjut:</strong>
        <div class="rich-text inline">
            @if($session->follow_up_plan)
            {!! $session->follow_up_plan !!}
            @else
            Dilakukan pemanggilan karyawan untuk di berikan konseling / edukasi terkait kesehatan mental kerja.
            @endif
        </div>
    </div>
    <p><strong>d. Penutup:</strong> Demikian laporan stress kerja bulanan ini dibuat. Diharapkan laporan ini dapat bermanfaat untuk meningkatkan kesehatan mental pekerja di tempat kerja.</p>
</div>