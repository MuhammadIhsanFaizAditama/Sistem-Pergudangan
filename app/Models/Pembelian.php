<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';


    protected $fillable = [
        'no_faktur',
        'tanggal',
        'total_harga',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'total_harga' => 'desimal:2',
    ];

    public function detailPembelian(){
        return $this -> hasMany(DetailPembelian::class);
    }

    public function supllier(){
        return $this-> belongsTo(Supplier::class);
    }

    public function user(){
        return $this -> belongsTo(User::class);
    }
}
