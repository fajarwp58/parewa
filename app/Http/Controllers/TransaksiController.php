<?php

namespace App\Http\Controllers;

use App\DetailPenjualan;
use App\Penjualan;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

    public function cetak($id){
        $transaksi = DetailPenjualan::with('penjualan','menu')->where('id_penjualan',$id)->first();
        $menu = DB::table('detail_penjualan')
        ->join('menu','menu.id_menu','=','detail_penjualan.id_menu')
        ->where('detail_penjualan.id_penjualan','=',$transaksi->id_penjualan)
        ->get();
        $tgltransaksi = Carbon::parse($transaksi->penjualan->tgl_penjualan)->format('d/m/Y');

        return view('cetakTransaksi', compact('transaksi','tgltransaksi','menu'));
    }
}
