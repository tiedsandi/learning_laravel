<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function actionLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return redirect('dashboard')->with('success', 'Login Berhasil');
        } else {
            return back()->withErrors(['error' => 'Login Gagal, Silahkan Coba Lagi'])->withInput();
        }
    }
}
