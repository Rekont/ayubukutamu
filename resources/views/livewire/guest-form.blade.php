<div>
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center p-3 bg-blue-100 rounded-full mb-4 shadow-inner">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
        </div>
        <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-purple-600 tracking-tight">Buku Tamu Digital</h2>
        <p class="text-gray-500 font-medium mt-2">{{ $event->name }} &bull; {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</p>
    </div>

    @if ($isSubmitted)
        <div class="bg-gradient-to-r from-green-400 to-green-500 rounded-2xl p-8 text-center text-white shadow-lg transform transition-all scale-100">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-white/20 mb-4">
                <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-2">Check-in Berhasil!</h3>
            <p class="text-green-50">Terima kasih, data kehadiran Anda telah tercatat. Silakan masuk ke ruangan acara.</p>
        </div>
    @else
        <form wire:submit.prevent="submit" id="guestForm" class="space-y-6">
            <div class="relative">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" wire:model="name" class="block w-full rounded-xl border-gray-300 bg-gray-50/50 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:bg-white transition-colors duration-200 p-3" placeholder="Masukkan nama Anda" required>
                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-gray-400 font-normal">(Opsional)</span></label>
                    <input type="email" wire:model="email" class="block w-full rounded-xl border-gray-300 bg-gray-50/50 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:bg-white transition-colors duration-200 p-3" placeholder="nama@email.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">No. WhatsApp</label>
                    <input type="text" wire:model="phone" class="block w-full rounded-xl border-gray-300 bg-gray-50/50 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:bg-white transition-colors duration-200 p-3" placeholder="0812xxxxxx">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Instansi / Perusahaan</label>
                <input type="text" wire:model="institution" class="block w-full rounded-xl border-gray-300 bg-gray-50/50 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:bg-white transition-colors duration-200 p-3" placeholder="Asal instansi Anda">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Selfie (Opsional)</label>
                <input type="file" wire:model="photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all border border-gray-300 rounded-xl bg-gray-50/50 p-1">
                <div wire:loading wire:target="photo" class="text-sm text-blue-500 mt-2 flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    Mengunggah foto...
                </div>
                @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div wire:ignore class="relative">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tanda Tangan <span class="text-red-500">*</span></label>
                <div class="border-2 border-dashed border-gray-300 rounded-2xl bg-white overflow-hidden shadow-sm relative group hover:border-blue-400 transition-colors">
                    <canvas id="signature-pad" class="w-full h-48 cursor-crosshair"></canvas>
                    
                    <button type="button" id="clear-signature" class="absolute top-2 right-2 bg-red-100 text-red-600 p-1.5 rounded-lg text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Hapus
                    </button>
                </div>
            </div>
            @error('signatureData') <span class="text-red-500 text-xs mt-1 block">Silakan berikan tanda tangan Anda.</span> @enderror

            <input type="hidden" wire:model="signatureData" id="signature_data">

            <button type="submit" wire:loading.attr="disabled" class="w-full flex justify-center items-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-70 disabled:cursor-not-allowed">
                
                <span wire:loading.remove wire:target="submit">Kirim Kehadiran</span>
                
                <span wire:loading wire:target="submit" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    Memproses Data...
                </span>
            </button>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                const canvas = document.getElementById('signature-pad');
                const form = document.getElementById('guestForm');
                const clearButton = document.getElementById('clear-signature');
                
                function resizeCanvas() {
                    const ratio =  Math.max(window.devicePixelRatio || 1, 1);
                    canvas.width = canvas.offsetWidth * ratio;
                    canvas.height = canvas.offsetHeight * ratio;
                    canvas.getContext("2d").scale(ratio, ratio);
                }
                window.addEventListener("resize", resizeCanvas);
                resizeCanvas();

                const signaturePad = new SignaturePad(canvas, {
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    penColor: 'rgb(30, 58, 138)' // Warna tinta biru tua agar elegan
                });

                clearButton.addEventListener('click', function (event) {
                    signaturePad.clear();
                    @this.set('signatureData', null);
                });

                form.addEventListener('submit', function (event) {
                    if (!signaturePad.isEmpty()) {
                        const dataUrl = signaturePad.toDataURL('image/png');
                        @this.set('signatureData', dataUrl);
                    }
                });
            });
        </script>
    @endif
</div>