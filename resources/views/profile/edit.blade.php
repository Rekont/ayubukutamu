<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-blue-600 bg-white p-2 rounded-full shadow-sm border border-slate-200 transition-all hover:scale-105" title="Kembali ke Dashboard">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
                    Pengaturan Profil
                </h2>
                <p class="text-slate-500 text-sm mt-1">Kelola informasi akun, kata sandi, dan keamanan Anda di sini.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white p-8 shadow-sm sm:rounded-3xl border border-slate-100 relative overflow-hidden group hover:shadow-md transition-shadow">
                <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-blue-400 to-blue-600"></div>
                
                <div class="max-w-2xl relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Informasi Pribadi</h3>
                    </div>
                    
                    <div class="pl-12">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 shadow-sm sm:rounded-3xl border border-slate-100 relative overflow-hidden group hover:shadow-md transition-shadow">
                <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-emerald-400 to-emerald-600"></div>
                
                <div class="max-w-2xl relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Keamanan & Sandi</h3>
                    </div>
                    
                    <div class="pl-12">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 shadow-sm sm:rounded-3xl border border-slate-100 relative overflow-hidden group hover:shadow-md transition-shadow">
                <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-red-400 to-red-600"></div>
                
                <div class="max-w-2xl relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-red-50 text-red-600 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-red-600">Zona Berbahaya</h3>
                    </div>
                    
                    <div class="pl-12">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>