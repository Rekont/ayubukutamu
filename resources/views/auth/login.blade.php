<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center p-3 bg-indigo-100 rounded-full mb-4 shadow-inner">
            <x-application-logo class="w-8 h-8 text-indigo-600" />
        </div>
        <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-indigo-600 tracking-tight">Selamat Datang</h2>        <p class="text-gray-500 font-medium mt-2">Silakan masuk ke panel admin Anda</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="block w-full rounded-xl border-gray-300 bg-gray-50/50 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:bg-white transition-colors duration-200 p-3">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-xl border-gray-300 bg-gray-50/50 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:bg-white transition-colors duration-200 p-3">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600 font-medium">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full flex justify-center items-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                Masuk ke Dashboard
            </button>
        </div>
        
        <div class="text-center mt-4">
            <p class="text-sm text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:underline">Daftar di sini</a></p>
        </div>
    </form>
</x-guest-layout>