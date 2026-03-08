@php
$coverPath = public_path('images/Cover.jpeg');
$coverBase64 = '';
if (file_exists($coverPath)) {
$coverData = file_get_contents($coverPath);
$coverBase64 = 'data:image/jpeg;base64,' . base64_encode($coverData);
}
@endphp
@if($coverBase64)
<style>
    .cover-page {
        background-image: url('{{ $coverBase64 }}');
    }

    .cover-title-group {
        margin-top: 35mm;
    }

    .info-below-logo {
        margin-top: 150mm;
        /* Positioned correctly below the central logo in the background template */
    }
</style>
@endif
<div class="text-center w-full px-16 cover-title-group">
    <h1 class="text-3xl font-bold uppercase tracking-wider mb-2" style="color: #0D1B3E;">Laporan Pengelolaan</h1>
    <h1 class="text-3xl font-bold uppercase tracking-wider mb-4" style="color: #0D1B3E;">Psikologi Kerja</h1>
    <h2 class="text-2xl font-bold uppercase" style="color: #0D1B3E;">Bulan {{ mb_strtoupper($monthYear) }}</h2>
</div>

<div class="text-center w-full px-16 info-below-logo">
    <h3 class="text-xl font-bold uppercase mb-1" style="color: #0D1B3E;">PT. Putra Perkasa Abadi</h3>
    <h3 class="text-lg font-bold uppercase mb-1" style="color: #0D1B3E;">SITE</h3>
    <h3 class="text-xl font-bold uppercase" style="color: #0D1B3E;">PT. Borneo Indobara</h3>
</div>