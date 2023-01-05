<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Konsumen;

class CsController extends Controller
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
        $menuku = "Penjualan";
        $namasub="Permintaan Order";

        $getbuton=getaccesbutton(11);

        $data = Konsumen::latest()->get();
        $last = DB::table('tb_counter')
            ->where('id','CST')
            ->get()
            ->toArray();

        $totalbelumdiambil=DB::select("SELECT COUNT(*) as totalambil FROM tb_penjualan WHERE status_dok='1'");
        $totalsudahdiambil=DB::select("SELECT COUNT(*) as totalambil FROM tb_penjualan WHERE status_dok='2'");
        $transhutang=DB::select("SELECT COUNT(*) as totalambil FROM tb_penjualan WHERE status_trs<'3'");
        $totalambil=$totalsudahdiambil[0]->totalambil;
        $hutang=$transhutang[0]->totalambil;

        return view('Order.Index', compact('menuku','namasub','totalambil','hutang'))
        ->with('konsumen',$data)
        ->with('butons',$getbuton)
        ->with('belumdiambil',$totalbelumdiambil);

        // return view('Order.Index', compact('menuku','namasub'))->with('butons',$getbuton);
    }
}
