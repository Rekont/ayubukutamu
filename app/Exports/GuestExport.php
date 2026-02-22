<?php

namespace App\Exports;

use App\Models\Guest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GuestExport implements FromCollection, WithHeadings, WithMapping
{
    protected $eventId;

    // Menerima ID Event dari Controller
    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    // Mengambil data tamu sesuai Event
    public function collection()
    {
        return Guest::where('event_id', $this->eventId)->orderBy('created_at', 'asc')->get();
    }

    // Menentukan judul kolom di baris pertama Excel
    public function headings(): array
    {
        return [
            'No',
            'Waktu Hadir',
            'Nama Lengkap',
            'Email',
            'No HP / WA',
            'Instansi',
        ];
    }

    // Memetakan data dari database ke dalam kolom Excel
    public function map($guest): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        return [
            $rowNumber,
            $guest->created_at->format('d/m/Y H:i:s'),
            $guest->name,
            $guest->email,
            $guest->phone,
            $guest->institution,
        ];
    }
}