<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiAlternatif extends Model
{
    public $timestamps = false;

    protected $table = 'nilai_alternatif';

    protected $fillable = [
        'alternatif_id',
        'kriteria_id',
        'nilai',
    ];

    protected function casts(): array
    {
        return [
            'nilai' => 'decimal:2',
        ];
    }

    public function alternatif(): BelongsTo
    {
        return $this->belongsTo(Alternatif::class);
    }

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }
}
