<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-6 border-b border-gray-200 bg-gray-50 text-center">
            <h2 class="text-2xl font-extrabold text-blue-900 leading-tight">
                Formulir Pengukuran Resiko Psikologi <br>
                PT. Putra Perkasa Abadi Site BIB 2026
            </h2>
            <div class="mt-4 max-w-2xl mx-auto space-y-3">
                <p class="text-sm text-gray-700 leading-relaxed">
                    Ini adalah survey yang dilakukan berdasarkan <strong>Permenaker 05 tahun 2018</strong> oleh Departemen SHE PT. PPA SITE BIB
                </p>
                <p class="text-xs text-red-600 font-bold bg-red-50 py-2 px-4 rounded-full border border-red-100 inline-block">
                    Setiap jawaban responden akan dijamin kerahasiaannya identitas, jawaban dan tidak akan mempengaruhi psikososial maupun karir responden
                </p>
            </div>
        </div>

        @if($isSubmitted)
        <div class="p-8">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-4">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900">Terima Kasih!</h3>
                <p class="mt-2 text-gray-500">Kuesioner Anda telah berhasil dikirimkan dan tersimpan di sistem.</p>
            </div>

            <div class="mt-8">
                <h4 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4 text-center">Ringkasan Hasil Diagnosis Stres Kerja</h4>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 shadow-inner max-w-2xl mx-auto">


                    <div class="space-y-3 mt-4">
                        <p class="text-sm text-gray-500 font-medium mb-3 uppercase tracking-wider text-center sm:text-left">Rincian Skor Per Dimensi:</p>
                        @foreach($finalScores as $label => $score)
                        @if($label !== 'Total Skor')
                        <div class="flex flex-col sm:flex-row justify-between items-center py-3 border-b border-gray-100 last:border-0 gap-2 sm:gap-0">
                            <span class="text-gray-700 font-medium text-center sm:text-left">{{ $label }}</span>
                            <span class="font-bold text-gray-900 border px-3 py-1 rounded-md text-sm text-center
                                {{ str_contains($score, 'RINGAN') ? 'bg-green-100 text-green-800 border-green-200' : '' }}
                                {{ str_contains($score, 'SEDANG') ? 'bg-yellow-100 text-yellow-800 border-yellow-200' : '' }}
                                {{ str_contains($score, 'BERAT') ? 'bg-red-100 text-red-800 border-red-200' : '' }}
                            ">{{ $score }}</span>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-300 flex justify-between items-center">
                        <span class="font-bold text-gray-800 text-lg">Total Skor Keseluruhan</span>
                        <span class="font-black text-blue-600 text-xl">{{ $finalScores['Total Skor'] ?? 0 }}</span>
                    </div>
                </div>

                <div class="mt-8 text-center text-sm text-gray-500">
                    <p>Silakan hubungi bagian HRD terkait jika ada pertanyaan lebih lanjut.</p>
                </div>
            </div>
        </div>
        @else
        <form wire:submit.prevent="submit" class="p-6">

            <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Informasi Pekerja</h3>

            <!-- Biodata Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" wire:model.defer="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border uppercase">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Pengisian <span class="text-red-500">*</span></label>
                    <input type="date" wire:model.defer="date" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm p-2 border bg-gray-100 text-gray-500 cursor-not-allowed">
                    @error('date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Perusahaan <span class="text-red-500">*</span></label>
                    <input type="text" wire:model.defer="company" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border uppercase">
                    @error('company') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Departemen / Divisi <span class="text-red-500">*</span></label>
                    <input type="text" wire:model.defer="department" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border uppercase">
                    @error('department') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" wire:model.defer="position" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border uppercase">
                    @error('position') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Batch / Angkatan <span class="text-red-500">*</span></label>
                    <input type="text" wire:model.defer="batch" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm p-2 border bg-gray-100 uppercase text-gray-500 cursor-not-allowed">
                    @error('batch') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <h3 class="text-lg font-medium text-gray-900 mb-2 border-b pb-2 mt-4">Kuesioner</h3>

            <div class="space-y-4">
                @foreach($questions as $index => $question)
                <div class="p-4 border border-gray-200 rounded-md bg-white hover:bg-gray-50 transition shadow-sm">
                    <p class="text-base font-semibold text-gray-800 mb-3">{{ $question->number }}. {{ $question->body }} <span class="text-red-500">*</span></p>

                    <div class="flex flex-wrap gap-3 sm:gap-6 items-center mt-2">
                        @php
                        $likertScale = [
                        1 => 'Tidak pernah',
                        2 => 'Jarang sekali',
                        3 => 'Jarang',
                        4 => 'Kadang-kadang',
                        5 => 'Sering',
                        6 => 'Sering kali',
                        7 => 'Selalu',
                        ];
                        @endphp
                        @foreach($likertScale as $value => $label)
                        <label class="inline-flex items-center cursor-pointer p-2 rounded-lg hover:bg-blue-50 border border-transparent hover:border-blue-200 transition">
                            <input type="radio" wire:model.defer="answers.{{ $question->id }}" value="{{ $value }}" name="answers_{{ $question->id }}" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-gray-300" required>
                            <span class="ml-2 text-sm font-medium text-gray-700">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('answers.'.$question->id) <span class="text-red-500 text-xs block mt-1">Harap pilih salah satu nilai</span> @enderror
                </div>
                @endforeach
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 w-full sm:w-auto text-lg">
                    Kirim Jawaban Kuesioner
                </button>
            </div>

        </form>
        @endif
    </div>
</div>