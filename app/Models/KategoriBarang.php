<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBarang extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    public $timestamps = false;

    protected $fillable = [
        'nama_kategori',
        'deskripsi'
    ];

    // Relationships

    public function barang(): HasMany
    {
        return $this->hasMany(Barang::class);
    }
}
