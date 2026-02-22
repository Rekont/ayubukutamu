<?php

namespace App\Mail;

use App\Models\Guest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class GuestBadgeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $guest;

    // Menerima data tamu saat dipanggil
    public function __construct(Guest $guest)
    {
        $this->guest = $guest;
    }

    // Mengatur Subjek Email
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Terima Kasih! Ini Badge Kehadiran Anda - ' . $this->guest->event->name,
        );
    }

    // Mengatur Tampilan (View) isi Email
    public function content(): Content
    {
        return new Content(
            view: 'emails.guest_badge', // Kita akan buat file ini di langkah selanjutnya
        );
    }

    // Mengatur Lampiran (Attachment) file PDF
    public function attachments(): array
    {
        // Generate PDF secara on-the-fly (langsung di memori)
        $pdf = Pdf::loadView('pdf.badge', ['guest' => $this->guest])
                  ->setPaper('A6', 'portrait'); // Ukuran ID Card kecil

        return [
            Attachment::fromData(fn () => $pdf->output(), 'Badge-' . $this->guest->name . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}