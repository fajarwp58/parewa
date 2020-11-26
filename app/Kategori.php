<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'nama_kategori',
    ];

    public $timestamps = false;

    public function menu() {
        return $this->hasMany('App\Menu', 'id_kategori', 'id_kategori');
    }
}
