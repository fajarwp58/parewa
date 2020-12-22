<?php

namespace App\Http\Controllers;

use App\DetailPenjualan;
use App\Penjualan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(){
        return view('transaksipenjualan');
    }

    public function data()
    {
        $transaksi = Penjualan::with(['user','menu'])->orderBY('tgl_penjualan','DESC')->get();
        return DataTables::of($transaksi)
        ->editColumn('total_bayar', function ($transaksi) {
            return 'Rp. '.format_uang($transaksi->total_bayar);
        })
        ->toJson();
    }
}
