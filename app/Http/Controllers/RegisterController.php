<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;

class RegisterController extends Controller
{
    public function index(){
        return view('auths.register');
    }

    public function createDepartment(){
       $id_depart = Department::all();
       return view('auths.register',compact('id_depart'));
     }
     
    public function postRegister(Request $request){
       $validateData = $request->validate([
           "username" => 'required|max:255|unique:users',
           "id_department" => 'required',
           "role"  => 'required',
           "password" => 'required|min:6|max:255'
       ]);
       $validateData['password'] = bcrypt($validateData['password']);
       User::create($validateData);

       return back()->with('BerhasilRegister','Akun berhasil dibuat');
    }

}
