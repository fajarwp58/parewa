<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    protected $fillable = [
        'nama_menu','id_kategori','harga_jual',
    ];

    public $timestamps = false;

    public function kategori() {
        return $this->belongsTo('App\Kategori', 'id_kategori', 'id_kategori');
    }

    public function barang()
    {
        return $this->belongsToMany('App\Barang','resep','kode_barang','id_menu');
    }

    public function penjualan()
    {
        return $this->belongsToMany('App\Penjualan','detail_penjualan','id_penjualan','id_menu');
    }
}
