<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'kode_barang';
    protected $fillable = [
        'nama_barang','satuan', 'qty','tgl_expired', 'harga_modal',
    ];

    public $timestamps = false;

    public function pembelian()
    {
        return $this->belongsToMany('App\Pembelian','detail_pembelian','kode_barang','no_pembelian');
    }

    public function menu()
    {
        return $this->belongsToMany('App\Menu','resep','kode_barang','id_menu');
    }
}
