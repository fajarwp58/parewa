<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:user'],
            'email' => ['required', 'string', 'email', 'max:255'], 
            'alamat' => ['required', 'string', 'max:255'], 
            'no_hp' => ['required', 'string', 'max:255'], 
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    public function profile(){
        return view('profile');
    }

    public function kelolauser(){
        return view('kelolauser');
    }

    public function data()
    {
        $user = User::with('role')->get(); 
        return DataTables::of($user)->toJson();
    }

    public function create(Request $request){
        $valid = User::where('username',$request->username)->count();      //unttuk mencek data telah ada

        if($valid != 0){
             $message = ['error' => 'Data Telah ada,Gagal menambahkan!'];  //unttuk mencek data telah ada
             return response()->json($message);                             //unttuk mencek data  telah ada
        } 

        else{

         $user = new User;                              
         $user->username = $request->username;         
         $user->no_hp = $request->no_hp;        
         $user->alamat = $request->alamat;  
         $user->email = $request->email;      
         $user->id_role = $request->id_role;            
         $user->password = Hash::make($request['password']);    


         $user->save();                 
        }
    }

    public function listrole(){
        $role = Role::whereIn('id_role',[2,3]) 
        ->get();
        return json_encode($role); 
    }

    public function edit(Request $request,$id){ 

        $user = User::where('id_user',$id)->first();  
        $user->email = $request->email;       
        $user->no_hp = $request->no_hp;   
        $user->alamat = $request->alamat;     
        $user->update();                             
    }

    public function delete($id)
    {
      User::where('id_user', $id)->delete(); 
    }
}
