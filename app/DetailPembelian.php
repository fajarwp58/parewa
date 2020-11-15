<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = 'detail_pembelian';
    protected $fillable = [
        'no_pembelian','kode_branag','harga', 'sub_total', 'jumlah',
    ];

    public $timestamps = false;
    protected $primaryKey = 'kode_barang';

    public function barang() {
        return $this->belongsTo('App\Barang', 'kode_barang', 'kode_barang');
    }
    public function pembelian() {
        return $this->belongsTo('App\Pembelian', 'no_pembelian', 'no_pembelian');
    }
}
