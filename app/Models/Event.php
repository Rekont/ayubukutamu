<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    // Kolom yang boleh diisi
    protected $fillable = ['name', 'slug', 'event_date', 'location', 'description', 'is_active'];

    // Relasi: Satu Event memiliki banyak Guest (tamu)
    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }
}