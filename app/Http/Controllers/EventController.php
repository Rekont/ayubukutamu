<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Exports\GuestExport; 
use Maatwebsite\Excel\Facades\Excel; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    // Menampilkan daftar event
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->get();
        return view('events.index', compact('events'));
    }

    // Menampilkan form tambah event
    public function create()
    {
        Gate::authorize('is-admin');
        return view('events.create');
    }

    // Menyimpan data event baru ke database
    public function store(Request $request)
    {
        Gate::authorize('is-admin');
        $request->validate([
            'name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Membuat slug otomatis dari nama event (contoh: "Seminar IT" menjadi "seminar-it")
        $slug = Str::slug($request->name . '-' . time());

        Event::create([
            'name' => $request->name,
            'slug' => $slug,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'description' => $request->description,
            'is_active' => true,
        ]);

        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    // Menampilkan detail event beserta QR Code-nya
    public function show(Event $event)
    {
        // Membuat URL untuk di-scan oleh tamu (URL ini akan kita buat di Fase 3)
        $urlBukuTamu = url('/buku-tamu/' . $event->slug);
        
        // Generate QR Code berdasarkan URL tersebut
        $qrCode = QrCode::size(300)->generate($urlBukuTamu);

        return view('events.show', compact('event', 'qrCode', 'urlBukuTamu'));
    }

    public function guests(Event $event)
    {
        // Ambil semua data tamu
        $guests = $event->guests()->orderBy('created_at', 'desc')->get();
        $totalGuests = $guests->count();

        // Mengambil data untuk grafik kedatangan (dikelompokkan berdasarkan Jam)
        $chartData = $event->guests()
            ->select(DB::raw('HOUR(created_at) as hour'), DB::raw('count(*) as total'))
            ->groupBy('hour')
            ->pluck('total', 'hour')
            ->toArray();

        // Menyiapkan label (Jam) dan data (Jumlah) untuk Chart.js
        $labels = [];
        $data = [];
        foreach ($chartData as $hour => $total) {
            $labels[] = sprintf("%02d:00", $hour); // Format jam, misal: "08:00"
            $data[] = $total;
        }

        return view('events.guests', compact('event', 'guests', 'totalGuests', 'labels', 'data'));
    }

    // Fungsi untuk mendownload Excel
    public function export(Event $event)
    {
        $fileName = 'Daftar-Tamu-' . $event->slug . '.xlsx';
        return Excel::download(new GuestExport($event->id), $fileName);
    }
}