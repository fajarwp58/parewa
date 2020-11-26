<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(){

        $menu = Menu::all();
        return view('penjualan',['menu'=>$menu]);

    }
}
