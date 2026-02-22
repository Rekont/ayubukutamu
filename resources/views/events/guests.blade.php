<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            
            <div class="flex items-center gap-4">
                <a href="{{ route('events.index') }}" class="text-slate-400 hover:text-blue-600 bg-white p-2 rounded-full shadow-sm border border-slate-200 transition-all hover:scale-105" title="Kembali ke Daftar Event">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">Dashboard Tamu: {{ $event->name }}</h2>
                    <p class="text-slate-500 text-sm mt-1">Pantau kehadiran tamu secara real-time.</p>
                </div>
            </div>

            <a href="{{ route('events.export', $event->id) }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2.5 px-5 rounded-xl shadow-md transform hover:-translate-y-0.5 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Export Excel
            </a>
            
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl shadow-lg p-6 text-white flex flex-col justify-center items-center relative overflow-hidden">
                    <svg class="absolute -right-6 -bottom-6 w-48 h-48 text-white opacity-10" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                    <h3 class="text-blue-100 text-lg font-medium z-10">Total Kehadiran</h3>
                    <p class="text-6xl font-extrabold mt-2 z-10">{{ $totalGuests }}</p>
                    <p class="text-blue-200 mt-1 font-medium z-10">Orang telah hadir</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 lg:col-span-2">
                    <h3 class="text-slate-700 text-lg font-bold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        Tren Kedatangan
                    </h3>
                    <div class="h-56 relative w-full">
                        <canvas id="arrivalChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <h3 class="text-lg font-bold text-slate-800">Daftar Kehadiran Realtime</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-white text-slate-500 font-medium border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4">Waktu</th>
                                <th class="px-6 py-4">Info Tamu</th>
                                <th class="px-6 py-4">Instansi</th>
                                <th class="px-6 py-4 text-center">Tanda Tangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($guests as $guest)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="bg-slate-100 text-slate-700 py-1 px-3 rounded-lg font-medium">{{ $guest->created_at->format('H:i') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-100 to-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg flex-shrink-0">
                                            {{ substr($guest->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-base">{{ $guest->name }}</p>
                                            <p class="text-slate-500 text-xs">{{ $guest->phone ?? '-' }} &bull; {{ $guest->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium">{{ $guest->institution ?? '-' }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($guest->signature_path)
                                        <div class="inline-block p-1 border border-slate-200 rounded-lg bg-white shadow-sm">
                                            <img src="{{ asset('storage/' . $guest->signature_path) }}" alt="TTD" class="h-10 object-contain">
                                        </div>
                                    @else
                                        <span class="text-slate-400 italic">Tidak ada</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-slate-400">
                                        <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        <p class="text-base font-medium">Belum ada tamu yang check-in.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('arrivalChart');
        
        // Custom styling untuk Chart agar lebih estetik
        Chart.defaults.font.family = "'Figtree', sans-serif";
        Chart.defaults.color = '#64748b';

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Kehadiran',
                    data: {!! json_encode($data) !!},
                    borderColor: '#4f46e5', // Indigo-600
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#4f46e5',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4, // Membuat garis lebih melengkung halus
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        titleFont: { size: 13 },
                        bodyFont: { size: 14, weight: 'bold' },
                        displayColors: false,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    x: {
                        grid: { display: false, drawBorder: false }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9', drawBorder: false },
                        ticks: { stepSize: 1, padding: 10 }
                    }
                }
            }
        });
    </script>
</x-app-layout>