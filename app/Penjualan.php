<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $fillable = [
        'tgl_penjualan' , 'total_bayar' , 'id_user'
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'id_user', 'id_user');
    }

    public function detail_penjualan() {
        return $this->hasMany('App\DetailPenjualan', 'id_penjualan', 'id_penjualan');
    }

    public function menu()
    {
        return $this->belongsToMany('App\Many','detail_penjualan','id_menu','id_penjualan');
    }
}
