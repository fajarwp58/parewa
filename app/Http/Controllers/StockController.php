<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StockController extends Controller
{
    public function index(){
        return view('stock');
    }
    public function data()
    {
        $stock = Barang::all(); 
        return DataTables::of($stock)->toJson();
    }

    public function create(Request $request){
         $stock = new Barang;                              
         $stock->nama_barang = $request->nama_barang;         
         $stock->satuan = $request->satuan;        
         $stock->qty = 0; 
         $stock->tgl_expired = $request->tgl_expired; 
         $stock->harga_modal = $request->harga_modal;   

         $stock->save();                 
    }

    public function edit(Request $request,$id){ 

        $stock = Barang::where('kode_barang',$id)->first();  
        $stock->nama_barang = $request->nama_barang;         
         $stock->satuan = $request->satuan;        
         $stock->qty = $request->qty; 
         $stock->tgl_expired = $request->tgl_expired; 
         $stock->harga_modal = $request->harga_modal;     
        $stock->update();                             
    }

    public function delete($id)
    {
      Barang::where('kode_barang', $id)->delete(); 
    }
}
