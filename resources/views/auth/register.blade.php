<x-guest-layout>
<div class="text-center mb-8">
        <div class="inline-flex items-center justify-center p-3 bg-indigo-100 rounded-full mb-4 shadow-inner">
            <x-application-logo class="w-8 h-8 text-indigo-600" />
        </div>
        <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-indigo-600 tracking-tight">Selamat Datang</h2>
        <p class="text-gray-500 font-medium mt-2">Bergabunglah untuk mengelola event Anda</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="block w-full rounded-xl border-gray-300 bg-gray-50/50 shadow-sm focus:border-purple-500 focus:ring-purple-500 focus:bg-white transition-colors duration-200 p-3">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-500" />
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="block w-full rounded-xl border-gray-300 bg-gray-50/50 shadow-sm focus:border-purple-500 focus:ring-purple-500 focus:bg-white transition-colors duration-200 p-3">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                <input id="password" type="password" name="password" required autocomplete="new-password" class="block w-full rounded-xl border-gray-300 bg-gray-50/50 shadow-sm focus:border-purple-500 focus:ring-purple-500 focus:bg-white transition-colors duration-200 p-3">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="block w-full rounded-xl border-gray-300 bg-gray-50/50 shadow-sm focus:border-purple-500 focus:ring-purple-500 focus:bg-white transition-colors duration-200 p-3">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-500" />
            </div>
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full flex justify-center items-center bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                Daftar Sekarang
            </button>
        </div>

        <div class="text-center mt-4">
            <p class="text-sm text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-purple-600 hover:underline">Masuk di sini</a></p>
        </div>
    </form>
</x-guest-layout>