<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    public $timestamps = false;

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'satuan',
        'harga_beli',
        'harga_jual',
        'stok'
    ];

    protected $casts = [
        'harga_beli' => 'decimal:2',
        'harga_jual' => 'decimal:2',
        'stok' => 'integer'
    ];

    // Relationships

    public function kategoriBarang(){
        return $this -> belongsTo(KategoriBarang::class);
    }

    public function detailPembelian(){
        return $this -> hasMany(DetailPembelian::class);
    }

}
