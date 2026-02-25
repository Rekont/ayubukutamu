<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Livewire\GuestForm;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rute Publik (Akses Tanpa Login)
|--------------------------------------------------------------------------
*/

// 1. Halaman utama langsung diarahkan (redirect) ke halaman Login
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Form Buku Tamu (Wajib di luar middleware auth agar tamu bisa akses)
Route::get('/buku-tamu/{event:slug}', GuestForm::class)->name('buku-tamu');


/*
|--------------------------------------------------------------------------
| Rute Admin / Panitia (Wajib Login & Verifikasi)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        $totalEvents = Event::count();
        $totalGuests = Guest::count();
        
        // Menggunakan latest() yang lebih rapi dibanding orderBy('created_at', 'desc')
        $recentEvents = Event::latest()->take(3)->get();
        $recentGuests = Guest::with('event')->latest()->take(5)->get();

        return view('dashboard', compact('totalEvents', 'totalGuests', 'recentEvents', 'recentGuests'));
    })->name('dashboard');

    // Manajemen Event & Laporan
    Route::resource('events', EventController::class);
    Route::get('events/{event}/guests', [EventController::class, 'guests'])->name('events.guests');
    Route::get('events/{event}/export', [EventController::class, 'export'])->name('events.export');

    // Manajemen Profil (Dikelompokkan menggunakan Controller Grouping agar rapi)
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

});

require __DIR__.'/auth.php';
