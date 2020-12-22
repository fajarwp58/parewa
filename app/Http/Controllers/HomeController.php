<?php

namespace App\Http\Controllers;

use App\Pembelian;
use App\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $awal = date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y')));
      $akhir = date('Y-m-d');

      $tanggal = $awal;
      $data_tanggal = array();
      $data_pendapatan = array();

      while(strtotime($tanggal) <= strtotime($akhir)){
        $data_tanggal[] = (int)substr($tanggal,8,2);

        $pendapatan = Penjualan::where('tgl_penjualan', 'LIKE', "$tanggal%")->sum('total_bayar');

        $data_pendapatan[] = (int) $pendapatan;

        $tanggal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal)));
      }

        $now=Carbon::now();
        $pemasukanhariini = Penjualan::whereDate('tgl_penjualan', Carbon::today())->sum('total_bayar');
        $pemasukanbulanini = Penjualan::whereMonth('tgl_penjualan', $now->month)->sum('total_bayar');
        $pemasukantahunini = Penjualan::whereYear('tgl_penjualan', $now->year)->sum('total_bayar');
        $pemasukanseluruh = Penjualan::all()->sum('total_bayar');

        $pengeluaranhariini = Pembelian::whereDate('tgl_pembelian', Carbon::today())->sum('bayar');
        $pengeluaranbulanini = Pembelian::whereMonth('tgl_pembelian', $now->month)->sum('bayar');
        $pengeluarantahunini = Pembelian::whereYear('tgl_pembelian', $now->year)->sum('bayar');
        $pengeluaranseluruh = Pembelian::all()->sum('bayar');

        return view('home',[
            'pemasukanhariini'=>$pemasukanhariini,
            'pemasukanbulanini'=>$pemasukanbulanini,
            'pemasukantahunini'=>$pemasukantahunini,
            'pemasukanseluruh'=>$pemasukanseluruh,
            'pengeluaranhariini'=>$pengeluaranhariini,
            'pengeluaranbulanini'=>$pengeluaranbulanini,
            'pengeluarantahunini'=>$pengeluarantahunini,
            'pengeluaranseluruh'=>$pengeluaranseluruh,
            'awal'=>$awal,
            'akhir'=>$akhir,
            'data_pendapatan'=>$data_pendapatan,
            'data_tanggal'=>$data_tanggal,
            'now'=>$now,
        ]);
    }
}
