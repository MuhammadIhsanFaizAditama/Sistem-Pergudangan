<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = '_barang_table';
    public $timestamps = true;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'harga_barang',
        'harga_jual',
        'stok_sekarang',
        'kategori_id'
    ];

    protected $casts = [
        'harga_barang' => 'decimal:2',
        'harga_jual' => 'decimal:2',
        'stok_sekarang' => 'integer'
    ];

    // Relationships

    public function kategori(){
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
    }

    public function detailPembelian(){
        return $this->hasMany(DetailPembelian::class);
    }
}
