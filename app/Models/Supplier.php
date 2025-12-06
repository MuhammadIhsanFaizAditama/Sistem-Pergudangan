<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    public $timestamps = false;

    protected $fillable = [
        'nama_supplier',
        'nama_kontak',
        'no_hp'
    ];

    protected $casts = [
        'no_hp' => 'integer'
    ];

    public function pembelian(){
        return $this -> hasMany(Pembelian::class);
    }
}


