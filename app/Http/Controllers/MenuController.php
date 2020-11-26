<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Kategori;
use App\Menu;
use App\Resep;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    public function index(){
        return view('kelolamenu');
    }

    public function data()
    {
        $menu = Menu::with('kategori')->get(); 
        return DataTables::of($menu)->toJson();
    }

    public function listkategori(){
        $kategori = Kategori::all();
        return json_encode($kategori); 
    }

    public function listbarang(){
        $barang = Barang::all();
        return json_encode($barang); 
    }

    public function create(Request $request){
         $menu = new Menu();                              
         $menu->nama_menu = $request->nama_menu;
         $menu->id_kategori = $request->id_kategori;
         $menu->harga_jual = $request->harga_jual;         

         $menu->save();                 
    }

    public function resepcreate(Request $request){
        for ($i = 0; $i < count($request->kode_barang); $i++) {
            $resep = new Resep();
            $resep->id_menu = $request->id_menu;
            $resep->kode_barang = $request->kode_barang[$i];
            $resep->jumlah = $request->jumlah[$i];

            $resep->save();
        }

        return view('kelolamenu');
    }

    public function edit(Request $request,$id){ 

        $menu = Menu::where('id_menu',$id)->first();  
        $menu->nama_menu = $request->nama_menu;       
        $menu->harga_jual = $request->harga_jual;       
       
        $menu->update();                             
    }

    public function addresep($id)
    {
        $menu = Menu::where('id_menu',$id)->first();
        return view('addresep', compact('menu'));
    }

    public function delete($id)
    {
      Menu::where('id_menu', $id)->delete(); 
    }
}
