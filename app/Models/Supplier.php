<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = '_supplier';
    public $timestamps = true;

    protected $fillable = [
        'nama_supllier', // Typo in migration
        'nama_kontak',
        'no_telpon'      // Migration uses no_telpon, not no_hp
    ];

    protected $casts = [
        'no_telpon' => 'integer'
    ];

    public function getNamaSupplierAttribute()
    {
        return $this->attributes['nama_supllier'];
    }

    public function pembelian(){
        return $this -> hasMany(Pembelian::class);
    }
}


