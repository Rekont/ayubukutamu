<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
            Dashboard Utama
        </h2>
        <p class="text-slate-500 text-sm mt-1">Ringkasan aktivitas dan statistik aplikasi Buku Tamu Anda.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 text-white shadow-lg relative overflow-hidden flex flex-col md:flex-row items-center justify-between">
                <svg class="absolute right-0 top-0 w-64 h-64 text-white opacity-10 transform translate-x-1/3 -translate-y-1/4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                
                <div class="z-10 mb-4 md:mb-0">
                    <h3 class="text-3xl font-extrabold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-blue-100 font-medium">Ini adalah ringkasan data dari seluruh acara yang telah Anda buat.</p>
                </div>
                
                @can('is-admin')
                <div class="z-10">
                    <a href="{{ route('events.create') }}" class="bg-white text-indigo-600 hover:bg-blue-50 font-bold py-3 px-6 rounded-xl shadow-md transition-all duration-200 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Event Baru
                    </a>
                </div>
                @endcan
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex items-center gap-6 group hover:shadow-md transition-all">
                    <div class="bg-blue-100 text-blue-600 p-4 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-slate-500 font-semibold text-sm">Total Event Dibuat</p>
                        <h4 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalEvents }}</h4>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex items-center gap-6 group hover:shadow-md transition-all">
                    <div class="bg-emerald-100 text-emerald-600 p-4 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-slate-500 font-semibold text-sm">Total Kehadiran (Semua Event)</p>
                        <h4 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalGuests }}</h4>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800">Tamu Terbaru Masuk</h3>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @forelse ($recentGuests as $guest)
                            <div class="p-4 px-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-100 to-blue-100 text-blue-700 flex items-center justify-center font-bold flex-shrink-0">
                                        {{ substr($guest->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $guest->name }}</p>
                                        <p class="text-xs text-slate-500 flex items-center gap-1 mt-0.5">
                                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span> 
                                            Hadir di <strong>{{ $guest->event->name }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <span class="text-xs text-slate-400 font-medium bg-slate-100 px-2 py-1 rounded-md">{{ $guest->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <div class="p-8 text-center text-slate-500 font-medium">Belum ada data tamu.</div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800">Event Terbaru</h3>
                        <a href="{{ route('events.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="divide-y divide-slate-100 p-4">
                        @forelse ($recentEvents as $event)
                            <a href="{{ route('events.guests', $event->id) }}" class="block p-4 border border-slate-100 rounded-xl mb-3 hover:border-blue-300 hover:shadow-md transition-all group">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors">{{ $event->name }}</h4>
                                        <p class="text-sm text-slate-500 mt-1">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }} &bull; {{ $event->location }}</p>
                                    </div>
                                    <span class="bg-blue-50 text-blue-600 font-bold text-xs px-2 py-1 rounded-md">{{ $event->guests()->count() }} Tamu</span>
                                </div>
                            </a>
                        @empty
                            <div class="p-8 text-center text-slate-500 font-medium">Belum ada event yang dibuat.</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>