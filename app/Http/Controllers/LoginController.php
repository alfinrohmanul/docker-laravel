<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('Home');
        }else{
            return view('welcome');
        }
    }

    public function ceklogin(Request $request)
    {
        $data = [
            'email' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            return redirect('Home');
            
            ActivityLog::create(array(
                'log_name'      => 'Login',
                'keterangan'    => 'Masuk Aplikasi Wahana',
                'id_user'       => Auth::user()->id
            )); 

        }else{
            Session::flash('error', 'Username atau Password Salah');
            return redirect('/');
        }
        // $hash_password_saya = Hash::make('admin');
        // var_dump($hash_password_saya);
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}