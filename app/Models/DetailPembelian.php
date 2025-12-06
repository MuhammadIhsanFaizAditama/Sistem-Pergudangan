<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $table = 'detail_pembelian';

    protected $fillable = [
        'jumlah_beli',
        'harga_satuan',
        'subtotal',
    ];

    protected $casts = [
        'jumlah_beli' => 'integer',
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    // Relationships

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }

    public function pembelian(): BelongsTo
    {
        return $this->belongsTo(Pembelian::class);
    }
}
