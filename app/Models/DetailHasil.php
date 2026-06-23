<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailHasil extends Model
{
    public $timestamps = false;

    protected $table = 'detail_hasil';

    protected $fillable = [
        'hasil_id',
        'alternatif_id',
        'yi',
        'ranking',
    ];

    protected function casts(): array
    {
        return [
            'yi' => 'decimal:8',
        ];
    }

    public function hasilPerhitungan(): BelongsTo
    {
        return $this->belongsTo(HasilPerhitungan::class, 'hasil_id');
    }

    public function alternatif(): BelongsTo
    {
        return $this->belongsTo(Alternatif::class);
    }
}
