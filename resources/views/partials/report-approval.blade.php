<div class="mb-8">
    <h3 class="text-xl font-bold mb-4" id="pengesahan">1. Lembar Pengesahan</h3>
    <p class="text-justify indent-8 leading-relaxed mb-8">
        Laporan ini disusun berdasarkan penilaian psikologi kerja pada PT. Putra Perkasa Abadi Site PT. Borneo Indobara yang dilaksanakan pada {{ $monthYear }} dengan harapan dapat meningkatkan derajat kesehatan tenaga kerja khususnya kesehatan dalam aspek psikologi serta mengimplementasikan upaya kesehatan pekerja sesuai perundangan yang berlaku.
    </p>
    <table class="mb-12 border-none w-auto">
        <tr>
            <td class="font-bold pr-2 bg-transparent border-none p-0">Diterbitkan di</td>
            <td class="bg-transparent border-none p-0">: Hati'if</td>
        </tr>
        <tr>
            <td class="font-bold pr-2 bg-transparent border-none p-0">Tanggal Terbit</td>
            <td class="bg-transparent border-none p-0">: {{ $dateFormatted }}</td>
        </tr>
    </table>

    <div class="grid grid-cols-2 gap-4 text-center mt-12 mb-8">
        <div class="col-span-2 text-center mb-0">
            <p class="mb-4">Penyusun :</p>
        </div>
        <div class="flex flex-col items-center">
            <div class="h-20 flex items-center justify-center">
                @php
                $pic1Sig = $session->pic1_signature ?: (isset($globalSigners['pic1']) && $globalSigners['pic1']->signature ? Storage::url($globalSigners['pic1']->signature) : null);
                @endphp
                @if($pic1Sig)
                <img src="{{ $pic1Sig }}" class="max-h-20" alt="Signature PIC 1">
                @endif
            </div>
            <p class="font-bold underline mt-2">{{ $session->pic1_name ?: ($globalSigners['pic1']->name ?? '') }}</p>
            <p>{{ $session->pic1_role ?: ($globalSigners['pic1']->role ?? '') }}</p>
        </div>
        <div class="flex flex-col items-center">
            <div class="h-20 flex items-center justify-center">
                @php
                $pic2Sig = $session->pic2_signature ?: (isset($globalSigners['pic2']) && $globalSigners['pic2']->signature ? Storage::url($globalSigners['pic2']->signature) : null);
                @endphp
                @if($pic2Sig)
                <img src="{{ $pic2Sig }}" class="max-h-20" alt="Signature PIC 2">
                @endif
            </div>
            <p class="font-bold underline mt-2">{{ $session->pic2_name ?: ($globalSigners['pic2']->name ?? '') }}</p>
            <p>{{ $session->pic2_role ?: ($globalSigners['pic2']->role ?? '') }}</p>
        </div>
    </div>

    <div class="flex flex-col items-center mt-8">
        <p class="mb-4">Diperiksa :</p>
        <div class="h-20 flex items-center justify-center">
            @php
            $revSig = $session->reviewer_signature ?: (isset($globalSigners['reviewer']) && $globalSigners['reviewer']->signature ? Storage::url($globalSigners['reviewer']->signature) : null);
            @endphp
            @if($revSig)
            <img src="{{ $revSig }}" class="max-h-20" alt="Signature Reviewer">
            @endif
        </div>
        <p class="font-bold underline mt-2">{{ $session->reviewer_name ?: ($globalSigners['reviewer']->name ?? '') }}</p>
        <p>{{ $session->reviewer_role ?: ($globalSigners['reviewer']->role ?? '') }}</p>
    </div>
</div>