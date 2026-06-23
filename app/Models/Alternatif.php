<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alternatif extends Model
{
    public $timestamps = false;

    protected $table = 'alternatif';

    protected $fillable = [
        'kode',
        'nama',
        'lokasi',
        'deskripsi',
        'gambar',
    ];

    public function gambarUrl(): string
    {
        if ($this->gambar && file_exists(public_path('images/wisata/'.$this->gambar))) {
            return asset('images/wisata/'.$this->gambar);
        }

        return asset('images/wisata/default.jpg');
    }

    public function getRouteKeyName(): string
    {
        return 'kode';
    }

    public function getRouteKey(): mixed
    {
        return strtolower($this->kode);
    }

    public function resolveRouteBinding($value, $field = null): ?static
    {
        return static::query()
            ->whereRaw('LOWER(kode) = ?', [strtolower((string) $value)])
            ->first();
    }

    public function nilaiAlternatif(): HasMany
    {
        return $this->hasMany(NilaiAlternatif::class);
    }

    public function detailHasil(): HasMany
    {
        return $this->hasMany(DetailHasil::class);
    }
}
