<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use DataTables;
use App\Models\Sales;

class SalesController extends Controller
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
        $menuku = "Master Data";
        $namasub="Data Sales";
        $getbuton=getaccesbutton(5);
        return view('Sales.Index', compact('menuku','namasub'))->with('butons',$getbuton);
    }

    function TableSales(){
        $data = Sales::latest()->get();
        return Datatables::of($data)->make(true);
    }

    function SalesCreate(){
        $menuku = "Master Data";
        $namasub="Data Sales";
        $last = DB::table('tb_counter')
            ->where('id','SLS')
            ->get()
            ->toArray();

        $countermu=DB::select("select udf_generateucodemt('SLS')kode");
        
        $counter='S' . date('Ymd') . '00' . $last[0]->last_number;
        $primary=$countermu[0]->kode;

        return view('Sales.Create', compact('menuku','namasub','counter','primary'));
    }

    function SaveSales(Request $request){
        $menuku = "Master Data";
        $namasub="Data Sales";

        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute harus diisi minimal :min karakter ',
            'max' => ':attribute harus diisi maksimal :max karakter ',
        ];
        
        $namatri=[
            'kode_sales' => '',
            'no_sales'   => 'Nomer Sales',
            'nama_sales' => 'Nama Sales',
            'no_hp'     => 'No Telp',
            'kota'      => 'Kota',
            'alamat'    => 'Alamat'
        ];

        $this->validate($request,[
            'kode_sales'     => '',
            'no_sales'       => 'required|max:15',
            'nama_sales'     => 'required|max:35',
            'no_hp'             => 'required|max:13|min:10',
            'kota'              => 'required',
            'alamat'            => 'required',
         ],$messages,$namatri);

         Sales::create($request->all());

        return redirect()
                ->route('SalesCreate')
                ->with('succes','Sales Berhasil di Tambah');
    }

    function Salesupdate($id){
        $menuku = "Master Data";
        $namasub="Data Sales";

        $data = Sales::find($id);

        return view('Sales.Edit',compact('menuku','namasub'))->with('sales', $data);
    }

    function UpdateSales(Request $request){
        DB::table('tb_sales')->where('kode_sales',$request->kode_sales)->update([
            'nama_sales'     => $request->nama_sales,
            'no_hp'       => $request->no_hp,
            'kota'          => $request->kota,
            'alamat'        => $request->alamat
        ]);

        return redirect('/Sales')->with('succes','Sales Berhasil di Ubah');
    }
}
