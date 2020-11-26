<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualan';
    protected $fillable = [
        'id_penjualan' , 'id_menu' , 'qty' , 'total'
    ];

    public function penjualan() {
        return $this->belongsTo('App\Penjualan', 'id_penjualan', 'id_penjualan');
    }
    public function menu() {
        return $this->belongsTo('App\Menu', 'id_menu', 'id_menu');
    }
}
