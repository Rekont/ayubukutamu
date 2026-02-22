<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ayu Buku Tamu') }} - Admin</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234f46e5'><path d='M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c1.68 0 3.282.515 4.75 1.457.253.16.5-.022.5-.289V5.212a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z'/></svg>">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">
    
    <nav x-data="{ open: false }" class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            <div class="flex items-center space-x-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group shrink-0">
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-600 text-white p-2 rounded-xl group-hover:shadow-lg group-hover:scale-105 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="font-extrabold text-xl tracking-tight text-slate-800">Ayu<span class="text-blue-600">BukuTamu</span></span>
                </a>
                
                <div class="hidden md:flex space-x-6 h-full">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-slate-600 hover:text-blue-600 font-medium transition-colors border-b-2 px-1 pt-1 {{ request()->routeIs('dashboard') ? 'border-blue-600 text-blue-600' : 'border-transparent' }}">Dashboard</a>
                    
                    <a href="{{ route('events.index') }}" class="inline-flex items-center text-slate-600 hover:text-blue-600 font-medium transition-colors border-b-2 px-1 pt-1 {{ request()->routeIs('events.*') ? 'border-blue-600 text-blue-600' : 'border-transparent' }}">Semua Event</a>
                </div>
            </div>

            <div class="hidden md:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-slate-600 bg-slate-50 hover:text-blue-600 hover:bg-blue-50 focus:outline-none transition ease-in-out duration-150 group">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-2 group-hover:scale-105 transition-transform">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit', Auth::user()->id)" class="hover:bg-blue-50 hover:text-blue-600 font-medium">
                            Profil Saya
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="hover:bg-red-50 hover:text-red-600 font-medium">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 focus:text-slate-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-b border-slate-200 shadow-md absolute w-full z-40 transition-all duration-300 origin-top" x-transition>
        
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-3 border-l-4 text-base font-bold transition-colors {{ request()->routeIs('dashboard') ? 'border-blue-600 text-blue-700 bg-blue-50' : 'border-transparent text-slate-600 hover:text-blue-600 hover:bg-slate-50 hover:border-slate-300' }}">
                Dashboard
            </a>
            <a href="{{ route('events.index') }}" class="block pl-3 pr-4 py-3 border-l-4 text-base font-bold transition-colors {{ request()->routeIs('events.*') ? 'border-blue-600 text-blue-700 bg-blue-50' : 'border-transparent text-slate-600 hover:text-blue-600 hover:bg-slate-50 hover:border-slate-300' }}">
                Semua Event
            </a>
        </div>

        <div class="pt-4 pb-4 border-t border-slate-200 bg-slate-50">
            <div class="px-4 flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-extrabold text-base text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit', Auth::user()->id) }}" class="block pl-3 pr-4 py-3 border-l-4 border-transparent text-base font-bold text-slate-600 hover:text-blue-600 hover:bg-white transition-colors">
                    Profil Saya
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block pl-3 pr-4 py-3 border-l-4 border-transparent text-base font-bold text-red-600 hover:bg-red-50 transition-colors">
                        Keluar
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>

    @if (isset($header))
        <header class="bg-white shadow-sm border-b border-slate-200">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <main class="mb-12">
        {{ $slot }}
    </main>
</body>
</html>