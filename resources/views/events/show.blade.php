<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('events.index') }}" class="text-slate-400 hover:text-blue-600 bg-white p-2 rounded-full shadow-sm border border-slate-200 transition-all hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">QR Code Registrasi</h2>
                <p class="text-slate-500 text-sm mt-1">Bagikan kode ini kepada tamu undangan Anda.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden flex flex-col md:flex-row">
                
                <div class="p-8 md:p-12 md:w-1/2 flex flex-col justify-center bg-gradient-to-br from-slate-50 to-blue-50/50 relative overflow-hidden">
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center p-4 bg-white rounded-2xl mb-6 shadow-sm border border-blue-100 text-blue-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        </div>
                        
                        <h3 class="text-3xl font-extrabold text-slate-800 mb-2">{{ $event->name }}</h3>
                        <p class="text-slate-500 mb-2 font-medium flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-slate-600 mb-8 leading-relaxed mt-4">Tamu dapat men-scan QR Code di samping menggunakan kamera HP mereka, atau Anda dapat membagikan tautan di bawah ini secara langsung.</p>
                        
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-slate-700">Tautan Buku Tamu</label>
                            <div class="flex items-center gap-2">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                    </div>
                                    <input type="text" id="guestUrl" value="{{ $urlBukuTamu }}" readonly class="block w-full pl-10 rounded-xl border-slate-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-slate-600 p-3 text-sm font-medium">
                                </div>
                                <button onclick="copyToClipboard()" class="bg-blue-600 hover:bg-blue-700 text-white p-3.5 rounded-xl shadow-md transform hover:-translate-y-0.5 transition-all duration-200 flex-shrink-0 group" title="Salin Tautan">
                                    <svg class="w-5 h-5 group-active:scale-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </button>
                            </div>
                            <p id="copyMessage" class="text-emerald-500 text-sm font-bold opacity-0 transition-opacity duration-300 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Tautan berhasil disalin!
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-8 md:p-12 md:w-1/2 flex flex-col items-center justify-center border-t md:border-t-0 md:border-l border-slate-100 bg-white">
                    
                    <div id="printArea" class="bg-white p-8 rounded-3xl shadow-sm border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-center group hover:border-blue-300 transition-colors w-full max-w-sm">
                        <h4 class="font-extrabold text-slate-800 mb-6 text-xl hidden print-block tracking-tight">SCAN UNTUK PRESENSI</h4>
                        
                        <div id="qrContainer" class="p-4 bg-white rounded-2xl shadow-md border border-slate-100 transform group-hover:scale-105 transition-transform duration-300">
                            {!! $qrCode !!}
                        </div>
                        
                        <p class="text-slate-500 font-bold mt-8 hidden print-block text-lg">{{ $event->name }}</p>
                    </div>
                    
                    <div class="mt-8 flex justify-center w-full max-w-sm">
                    <button onclick="downloadQRPng()" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download QR CODE
                    </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

<script>
        function copyToClipboard() {
            var copyText = document.getElementById("guestUrl");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            
            var msg = document.getElementById("copyMessage");
            msg.classList.remove("opacity-0");
            setTimeout(function(){ msg.classList.add("opacity-0"); }, 2500);
        }

        function downloadQRPng() {
            const svg = document.querySelector('#qrContainer svg');
            const svgData = new XMLSerializer().serializeToString(svg);
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const size = 1000; 
            canvas.width = size;
            canvas.height = size;
            const img = new Image();
            
            img.onload = function() {
                ctx.fillStyle = 'white';
                ctx.fillRect(0, 0, size, size);
                ctx.drawImage(img, 0, 0, size, size);
                const pngFile = canvas.toDataURL('image/png');
                const downloadLink = document.createElement('a');
                downloadLink.download = 'QR-Code-Event.png';
                downloadLink.href = pngFile;
                downloadLink.click();
            };
            
            img.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgData)));
        }
    </script>
</x-app-layout>