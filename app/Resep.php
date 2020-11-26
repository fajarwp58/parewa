<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'resep';
    protected $primaryKey = 'id_resep';
    protected $fillable = [
        'id_menu','kode_barang','jumlah',
    ];

    public $timestamps = false;

    public function barang() {
        return $this->belongsTo('App\Barang', 'kode_barang', 'kode_barang');
    }

    public function menu() {
        return $this->belongsTo('App\Menu', 'id_menu', 'id_menu');
    }
}
