<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    public function index(){
        return view('kelolasupplier');
    }

    public function data()
    {
        $supplier = Supplier::all(); 
        return DataTables::of($supplier)->toJson();
    }

    public function create(Request $request){
         $supplier = new Supplier;                              
         $supplier->nama_supplier = $request->nama_supplier;         
         $supplier->no_hp = $request->no_hp;        
         $supplier->alamat = $request->alamat;   

         $supplier->save();                 
    }

    public function edit(Request $request,$id){ 

        $supplier = Supplier::where('kode_supplier',$id)->first();  
        $supplier->nama_supplier = $request->nama_supplier;       
        $supplier->no_hp = $request->no_hp;   
        $supplier->alamat = $request->alamat;     
        $supplier->update();                             
    }

    public function delete($id)
    {
      Supplier::where('kode_supplier', $id)->delete(); 
    }
}
