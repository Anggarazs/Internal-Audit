<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(){
        return view('auths.login');
    }

    public function postLogin(Request $request){
        $credentials = $request->validate([
            "username" => 'required',
            "password" => 'required',
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if (Auth::user()->role == 'auditor') { // Role Auditor
                return redirect()->intended('/dashboard');
            } elseif ( Auth::user()->role == 'auditee') { // Role Auditee
                return redirect()->intended('/finding');
            } 
        }
      
        // if (Auth::check() && Auth::user()->role == 'auditor') { // Role Auditor
        //     return view('/dahsboard');
        // } elseif (Auth::check() && Auth::user()->role == 'auditee') { // Role Auditee
        //     return view('/finding');
        // } 
 
        return back()->with('LoginError','Gagal Login');
    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect('/login');
    }
}
