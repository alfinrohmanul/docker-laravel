<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use DataTables;

class PembayaranLainController extends Controller
{
    public function __construct()
    {
        if (Auth::check()) {
            return redirect('Home');
        }else{
            return view('welcome');
        }
    }

    function index(){
        $menuku = "Finance Accounting";
        $namasub="Pembayaran Lain";
        $getbuton=getaccesbutton(20);
        return view('Pembayaran.Index', compact('menuku','namasub'))->with('butons',$getbuton);
    }
}
