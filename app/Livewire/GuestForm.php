<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.guest')] 
class GuestForm extends Component
{
    use WithFileUploads; // Wajib dipanggil untuk fitur upload file

    public Event $event;
    
    // Variabel Form
    public $name, $email, $phone, $institution, $photo;
    public $signatureData; // Untuk menampung data tanda tangan (Base64)
    public $isSubmitted = false;

    // Method ini otomatis dijalankan saat halaman pertama kali dibuka
    public function mount(Event $event)
    {
        $this->event = $event;
        
        // Jika event sudah tidak aktif, kita bisa mencegah tamu mengisi form
        abort_if(!$this->event->is_active, 403, 'Event ini sudah ditutup.');
    }

    // Fungsi untuk menyimpan data tamu
    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'institution' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'signatureData' => 'required|string',
        ]);

        // 1. Simpan Foto
        $photoPath = null;
        if ($this->photo) {
            $photoPath = $this->photo->store('guests/photos', 'public');
        }

        // 2. Simpan Tanda Tangan
        $signaturePath = null;
        if ($this->signatureData) {
            $image_parts = explode(";base64,", $this->signatureData);
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = 'guests/signatures/' . uniqid() . '.png';
            
            \Illuminate\Support\Facades\Storage::disk('public')->put($fileName, $image_base64);
            $signaturePath = $fileName;
        }

        // 3. Simpan ke Database
        $newGuest = Guest::create([
            'event_id' => $this->event->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'institution' => $this->institution,
            'signature_path' => $signaturePath,
            'photo_path' => $photoPath,
        ]);

        // 4. KIRIM EMAIL OTOMATIS (Jika ada)
        if ($this->email) {
            try {
                \Illuminate\Support\Facades\Mail::to($this->email)->send(new \App\Mail\GuestBadgeMail($newGuest));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Gagal kirim email: ' . $e->getMessage());
            }
        }

        // 5. KIRIM NOTIFIKASI WHATSAPP VIA FONNTE (Jika ada no HP)
        if ($this->phone) {
            try {
                $waToken = env('FONNTE_TOKEN');
                
                if ($waToken) {
                    // Merakit isi pesan WhatsApp
                    $waMessage = "Halo *{$this->name}*! 👋\n\n";
                    $waMessage .= "Terima kasih telah hadir di acara *{$this->event->name}*.\n\n";
                    $waMessage .= "Data kehadiran Anda telah berhasil dicatat oleh sistem kami.\n\n";
                    $waMessage .= "Selamat mengikuti acara!\n\n";
                    $waMessage .= "Salam hangat,\n*Panitia {$this->event->name}*";

                    // Mengirim request ke API Fonnte
                    \Illuminate\Support\Facades\Http::withHeaders([
                        'Authorization' => $waToken,
                    ])->post('https://api.fonnte.com/send', [
                        'target' => $this->phone,
                        'message' => $waMessage,
                        'countryCode' => '62', // Otomatis mengubah awalan 08 menjadi 628 (standar WA)
                    ]);
                }
            } catch (\Exception $e) {
                // Menyembunyikan error agar form tamu tidak ikut crash (hanya dicatat di log)
                \Illuminate\Support\Facades\Log::error('Gagal kirim WA Fonnte: ' . $e->getMessage());
            }
        }

        // Ubah status sukses
        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.guest-form')->layout('layouts.guest');
    }
}