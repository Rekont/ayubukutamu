<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Models\Event;
use App\Livewire\GuestForm;
use App\Models\Guest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Mengambil statistik global
    $totalEvents = Event::count();
    $totalGuests = Guest::count();
    
    // Mengambil 3 event terbaru dan 5 tamu terbaru untuk ditampilkan di dashboard
    $recentEvents = Event::orderBy('created_at', 'desc')->take(3)->get();
    $recentGuests = Guest::with('event')->orderBy('created_at', 'desc')->take(5)->get();

    return view('dashboard', compact('totalEvents', 'totalGuests', 'recentEvents', 'recentGuests'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('events', EventController::class);
    Route::get('/buku-tamu/{event:slug}', GuestForm::class)->name('buku-tamu');
    Route::get('events/{event}/guests', [EventController::class, 'guests'])->name('events.guests');
    Route::get('events/{event}/export', [EventController::class, 'export'])->name('events.export');
});

require __DIR__.'/auth.php';
