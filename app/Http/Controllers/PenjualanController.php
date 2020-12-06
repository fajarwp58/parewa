<?php

namespace App\Http\Controllers;

use App\DetailPenjualan;
use App\Menu;
use App\Penjualan;
use Carbon\Carbon;
use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Redirect;

class PenjualanController extends Controller
{
    public function index(){
        $now = Carbon::now();

        $menu = Menu::all();
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(1000, 9999)
            . $characters[rand(0, strlen($characters) - 1)];
        $AWAL = 'INV';

        $idmodal = $AWAL .'-'.str_shuffle($pin);

        $penjualan = new Penjualan;                              
        $penjualan->id_penjualan = $idmodal;         
        $penjualan->tgl_penjualan = $now;        
        $penjualan->total_bayar = 0; 
        $penjualan->id_user = Auth::user()->id_user; 

        $penjualan->save();        

        $data = Penjualan::orderBY('tgl_penjualan', 'DESC')->first();
        //dd($data);
        return view('penjualan', compact('menu','data'));

    }

    public function data(){
      $penjualan = Penjualan::orderBY('tgl_penjualan', 'DESC')->first(); 
      $detail = DetailPenjualan::leftJoin('menu', 'menu.id_menu', '=', 'detail_penjualan.id_menu')
      ->where('id_penjualan', '=', $penjualan->id_penjualan)
      ->get();
        return DataTables::of($detail)->toJson();
    }

    public function listData2(){
        $penjualan = Penjualan::orderBY('tgl_penjualan', 'DESC')->first();
        $detail = DetailPenjualan::leftJoin('menu', 'menu.id_menu', '=', 'detail_penjualan.id_menu')
           ->where('id_penjualan', '=', $penjualan->id_penjualan)
           ->get();

        $data = array();
        $total = 0;
        $total_item = 0;
        foreach($detail as $list){
          $row = array();
          $row[] = $list->nama_menu;
          $row[] = "Rp. ".format_uang($list->harga_jual);
          $row[] = "<input type='number' class='form-control' name='jumlah_$list->id_detail_penjualan' value='$list->qty' onChange='changeCount($list->id_detail_penjualan)'>";
          $row[] = "Rp. ".format_uang($list->harga_jual * $list->qty);
          $row[] = '<a data-id="'.$list->id_menu.'" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
          $data[] = $row;
   
          $total += $list->harga_jual * $list->qty;
          $total_item += $list->qty;
        }
   
        $data[] = array("<span class='hide total' style='display: none;'>$total</span><span style='display: none;' class='hide totalitem'>$total_item</span>", "", "", "", "");
       
        $output = array("data" => $data);
        return response()->json($output);
      }

      public function store2(Request $request)
   {
      $menu = Menu::where('id_menu', '=', $request['kode'])->first();
      $detail = new DetailPenjualan;
      $detail->id_penjualan = $request['nopembelian'];
      $detail->id_menu = $request['kode'];
      $detail->qty = $request['jumlah'];
      $detail->total = $menu->harga_jual*$request['jumlah'];
      $detail->save();
   }

   public function loadForm($diskon, $total){
    $bayar = $total - ($diskon / 100 * $total);
    $data = array(
       "totalrp" => format_uang($total),
       "total" => $total,
       "bayar" => $bayar,
       "bayarrp" => format_uang($bayar),
       "terbilang" => ucwords(terbilang($bayar))." Rupiah"
     );
    return response()->json($data);
  }

  public function store(Request $request)
   {
    $now = Carbon::now();
      $penjualan = Penjualan::find($request['nopembelian']);
      $penjualan->tgl_penjualan = $now;
      $penjualan->total_bayar = $request['totalrp'];
      $penjualan->update();

      $detail = DetailPenjualan::where('id_penjualan', '=', $request['nopembelian'])->get();
      foreach($detail as $da){
      $detail2 = Menu::leftJoin('resep', 'resep.id_menu', '=', 'menu.id_menu')
           ->where('menu.id_menu', '=', $da->id_menu)
           ->get();
      foreach($detail2 as $data){
        $produk = Barang::where('kode_barang', '=', $data->kode_barang)->first();
        $produk->qty -= $data->jumlah;
        $produk->update();
      }}
      return Redirect::route('pembelian.index');
   }

   public function delete($id)
    {

      DetailPenjualan::where('id_menu', $id)->delete();

    }

    
}
