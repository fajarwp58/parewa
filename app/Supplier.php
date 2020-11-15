<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'kode_supplier';
    protected $fillable = [
        'nama_supplier','alamat', 'no_hp',
    ];

    public $timestamps = false;

    public function pembelian() {
        return $this->hasMany('App\Pembelian', 'kode_supplier', 'kode_supplier');
    }
}
