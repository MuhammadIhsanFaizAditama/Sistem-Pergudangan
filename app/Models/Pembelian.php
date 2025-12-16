<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = '_pembelian';
    public $timestamps = true;

    protected $fillable = [
        'no_faktur',
        'tanggal',
        'total_harga',
        'status',
        'supplier_id',
        'user_id'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'total_harga' => 'decimal:2',
    ];

    public function detailPembelian(){
        return $this->hasMany(DetailPembelian::class, 'pembelian_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
