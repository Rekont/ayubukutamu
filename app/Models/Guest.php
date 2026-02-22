<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guest extends Model
{
    // Kolom yang boleh diisi
    protected $fillable = ['event_id', 'name', 'email', 'phone', 'institution', 'signature_path', 'photo_path'];

    // Relasi: Satu Guest (tamu) menghadiri satu Event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}