<?php

namespace App\Models;

use App\KriteriaTipe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    public $timestamps = false;

    protected $table = 'kriteria';

    protected $fillable = [
        'kode',
        'nama',
        'tipe',
        'bobot',
    ];

    protected function casts(): array
    {
        return [
            'tipe' => KriteriaTipe::class,
            'bobot' => 'decimal:2',
        ];
    }

    public function nilaiAlternatif(): HasMany
    {
        return $this->hasMany(NilaiAlternatif::class);
    }
}
