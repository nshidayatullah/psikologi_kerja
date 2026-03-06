<div class="max-w-2xl mx-auto py-10 px-4">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="bg-blue-600 px-6 py-4 text-white">
            <h2 class="text-xl font-bold">Tanda Tangan Digital</h2>
            <p class="text-blue-100 text-sm">Sesi: {{ $session->title }}</p>
        </div>

        <div class="p-6">
            @if ($isSubmitted)
            <div class="text-center py-10">
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <h3 class="text-xl font-bold">Terima Kasih!</h3>
                    <p>Tanda tangan berhasil disimpan.</p>
                </div>
                <button onclick="window.close()" class="text-blue-600 hover:underline">Tutup Halaman</button>
            </div>
            @else
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Anda menandatangani sebagai:</p>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <p class="font-bold text-lg text-gray-800">{{ $signerName }}</p>
                    <p class="text-gray-500">{{ $signerRole }}</p>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Silakan Tanda Tangan di bawah ini:</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 overflow-hidden" style="touch-action: none;">
                    <canvas id="signature-pad" class="w-full h-64 cursor-crosshair"></canvas>
                </div>
                <p class="text-xs text-gray-400 mt-2 italic">* Gunakan jari atau mouse untuk menandatangani</p>
            </div>

            <div class="flex gap-4">
                <button id="clear-btn" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Bersihkan
                </button>
                <button id="save-btn" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition font-bold">
                    Simpan Tanda Tangan
                </button>
            </div>
            @endif
        </div>
    </div>

    @if (!$isSubmitted)
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            initSignaturePad();
        });

        // Also run on initial load
        document.addEventListener('DOMContentLoaded', () => {
            initSignaturePad();
        });

        function initSignaturePad() {
            const canvas = document.getElementById('signature-pad');
            if (!canvas) return;

            // Handle high DPI screens
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);

            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 0)'
            });

            document.getElementById('clear-btn').addEventListener('click', () => {
                signaturePad.clear();
            });

            document.getElementById('save-btn').addEventListener('click', () => {
                if (signaturePad.isEmpty()) {
                    alert('Silakan isi tanda tangan terlebih dahulu.');
                    return;
                }

                const dataUrl = signaturePad.toDataURL();
                Livewire.first().call('saveSignature', dataUrl);
            });
        }
    </script>
    @endif
</div>