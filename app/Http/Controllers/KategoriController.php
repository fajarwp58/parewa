<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    public function index(){
        return view('kelolakategori');
    }

    public function data()
    {
        $kategori = Kategori::all(); 
        return DataTables::of($kategori)->toJson();
    }

    public function create(Request $request){
         $kategori = new Kategori();                              
         $kategori->nama_kategori = $request->nama_kategori;         

         $kategori->save();                 
    }

    public function edit(Request $request,$id){ 

        $kategori = Kategori::where('id_kategori',$id)->first();  
        $kategori->nama_kategori = $request->nama_kategori;       
       
        $kategori->update();                             
    }

    public function delete($id)
    {
      Kategori::where('id_kategori', $id)->delete(); 
    }
}
