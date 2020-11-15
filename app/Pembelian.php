<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'no_pembelian';
    protected $fillable = [
        'tgl_pembelian','kode_supplier', 'id_user','total_item','total_bayar','diskon','bayar',
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'id_user', 'id_user');
    }
    public function role() {
        return $this->belongsTo('App\Role', 'id_role', 'id_role');
    }
    public function supplier() {
        return $this->belongsTo('App\Supplier', 'kode_supplier', 'kode_supplier');
    }
    public function barang()
    {
        return $this->belongsToMany('App\Barang','detail_pembelian','kode_barang','no_pembelian');
    }
}
