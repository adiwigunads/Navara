<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HasilPerhitungan extends Model
{
    public $timestamps = false;

    protected $table = 'hasil_perhitungan';

    protected $fillable = [
        'tanggal',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'datetime',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function detailHasil(): HasMany
    {
        return $this->hasMany(DetailHasil::class, 'hasil_id');
    }
}
