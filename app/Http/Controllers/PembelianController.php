<?php

namespace App\Http\Controllers;

use App\Barang;
use App\DetailPembelian;
use App\Supplier;
use App\Pembelian;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PembelianController extends Controller
{
    public function index(){
        $supplier = Supplier::all();
        return view('pembelian.index',compact('supplier'));
    }

    public function detail(){
      $supplier = Pembelian::leftJoin('supplier', 'supplier.kode_supplier', '=', 'pembelian.kode_supplier')
      ->orderBY('no_pembelian', 'DESC')->first();
      $produk = Barang::all();
      return view('pembelian_detail.index',compact('supplier','produk'));
  }

    public function listData(){
     $pembelian = Pembelian::leftJoin('supplier', 'supplier.kode_supplier', '=', 'pembelian.kode_supplier')
        ->orderBy('pembelian.no_pembelian', 'desc')
        ->get();
     $no = 0;
     $data = array();
     foreach($pembelian as $list){
       $no ++;
       $row = array();
       $row[] = $no;
       $row[] = tanggal_indonesia(substr($list->tgl_pembelian, 0, 10), false);
       $row[] = $list->nama_supplier;
       $row[] = "Rp. ".format_uang($list->total_bayar);
       $row[] = $list->diskon."%";
       $row[] = "Rp. ".format_uang($list->bayar);
       $row[] = '<div class="btn-group">
               <a onclick="showDetail('.$list->no_pembelian.')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
               <a data-id="'.$list->no_pembelian.'" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
              </div>';
       $data[] = $row;
     }

     $output = array("data" => $data);
     return response()->json($output);
   }

   public function listData2(){
     $supplier = Pembelian::leftJoin('supplier', 'supplier.kode_supplier', '=', 'pembelian.kode_supplier')
     ->orderBY('no_pembelian', 'DESC')->first();
     $detail = DetailPembelian::leftJoin('barang', 'barang.kode_barang', '=', 'detail_pembelian.kode_barang')
        ->where('no_pembelian', '=', $supplier->no_pembelian)
        ->get();
     $no = 0;
     $data = array();
     $total = 0;
     $total_item = 0;
     foreach($detail as $list){
       $no ++;
       $row = array();
       $row[] = $no;
       $row[] = $list->kode_barang;
       $row[] = $list->nama_barang;
       $row[] = "Rp. ".format_uang($list->harga);
       $row[] = "<input type='number' class='form-control' name='jumlah_$list->id_detail_pembelian' value='$list->jumlah' onChange='changeCount($list->id_detail_pembelian)'>";
       $row[] = "Rp. ".format_uang($list->harga * $list->jumlah);
       $row[] = '<a data-id="'.$list->kode_barang.'" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
       $data[] = $row;

       $total += $list->harga * $list->jumlah;
       $total_item += $list->jumlah;
     }

     $data[] = array("<span class='hide total' style='display: none;'>$total</span><span style='display: none;' class='hide totalitem'>$total_item</span>", "", "", "", "", "", "");
    
     $output = array("data" => $data);
     return response()->json($output);
   }

   public function show($id){
     $detail = DetailPembelian::leftJoin('barang', 'barang.kode_barang', '=', 'detail_pembelian.kode_barang')
        ->where('no_pembelian', '=', $id)
        ->get();
     $no = 0;
     $data = array();
     foreach($detail as $list){
       $no ++;
       $row = array();
       $row[] = $no;
       $row[] = $list->kode_barang;
       $row[] = $list->nama_barang;
       $row[] = "Rp. ".format_uang($list->harga);
       $row[] = $list->jumlah;
       $row[] = "Rp. ".format_uang($list->harga * $list->jumlah);
       $data[] = $row;
     }
    
     $output = array("data" => $data);
     return response()->json($output);
   }

   public function create($id)
   {
      $now = Carbon::now();

      $pembelian = new Pembelian;
      $pembelian->kode_supplier = $id;  
      $pembelian->id_user = Auth::user()->id_user; 
      $pembelian->tgl_pembelian = $now;  
      $pembelian->total_item = 0;     
      $pembelian->total_bayar= 0;     
      $pembelian->diskon = 0;     
      $pembelian->bayar = 0;     
      $pembelian->save();

      return Redirect::route('pembelian_detail.index');      
   }

   public function store(Request $request)
   {
    $now = Carbon::now();
      $pembelian = Pembelian::find($request['nopembelian']);
      $pembelian->tgl_pembelian = $now;
      $pembelian->total_bayar = $request['totalbayar'];
      $pembelian->total_item = $request['totalitem'];
      $pembelian->diskon = $request['diskon'];
      $pembelian->bayar = $request['bayar'];
      $pembelian->update();

      $detail = DetailPembelian::where('no_pembelian', '=', $request['nopembelian'])->get();
      foreach($detail as $data){
        $produk = Barang::where('kode_barang', '=', $data->kode_barang)->first();
        $produk->qty += $data->jumlah;
        $produk->update();
      }
      return Redirect::route('pembelian.index');
   }

   public function store2(Request $request)
   {
      $produk = Barang::where('kode_barang', '=', $request['kode'])->first();
      $detail = new DetailPembelian;
      $detail->no_pembelian = $request['nopembelian'];
      $detail->kode_barang = $request['kode'];
      $detail->harga = $produk->harga_modal;
      $detail->jumlah = 1;
      $detail->sub_total = $produk->harga_modal;
      $detail->save();
   }
   
   public function destroy($id)
   {
      $pembelian = Pembelian::find($id);
      $pembelian->delete();

      $detail = DetailPembelian::where('no_pembelian', '=', $id)->get();
      foreach($detail as $data){
        $produk = Barang::where('kode_barang', '=', $data->kode_barang)->first();
        $produk->qty -= $data->jumlah;
        $produk->update();
        $data->delete();
      }
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

  public function update(Request $request, $id)
   {
      $nama_input = "jumlah_".$id;
      $detail = DetailPembelian::where('id_detail_pembelian',$id)->orderBY('id_detail_pembelian', 'DESC')->first();
      $detail->jumlah = $request[$nama_input];
      $detail->sub_total = $detail->harga * $request[$nama_input];
      $detail->update();
   }

   public function delete($id)
    {

      DetailPembelian::where('kode_barang', $id)->delete();

    }

    public function delete2($id)
    {

      Pembelian::where('no_pembelian', $id)->delete();

    }

}
