<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use DataTables;
use App\Models\Bank;

class BankController extends Controller
{
    public function __construct()
    {
        if (Auth::check()) {
            return redirect('Home');
        }else{
            return view('welcome');
        }
    }

    public function index()
    {
        $menuku = "Master Data";
        $namasub="Data Bank";

        $getbuton=getaccesbutton(6);

        return view('Bank.Index', compact('menuku','namasub'))->with('butons',$getbuton);
    }

    function TableBank(){
        $data = Bank::latest()->get();
        return Datatables::of($data)->make(true);
    }

    function CreateBank(){
        $menuku = "Master Data";
        $namasub="Data Bank";

        return view('Bank.Create', compact('menuku','namasub'));
    }

    function SaveBank(Request $request){
        $menuku = "Master Data";
        $namasub="Data Bank";

        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute harus diisi minimal :min karakter ',
            'max' => ':attribute harus diisi maksimal :max karakter ',
        ];
        
        $namatri=[
            'nama_bank'      => 'Nama Bank',
            'no_rekening'    => 'Rekening'
        ];

        $this->validate($request,[
            'nama_bank'     => 'required',
            'no_rekening'       => 'required|max:15',
         ],$messages,$namatri);

        Bank::create($request->all());

        return redirect()
                ->route('CreateBank')
                ->with('succes','Bank Berhasil di Tambah');
    }

    function BankUpdate($id){
        $menuku = "Master Data";
        $namasub="Data Bank";

        $data = Bank::find($id);

        return view('Bank.Edit',compact('menuku','namasub'))->with('bank', $data);
    }

    function UpdateBank(Request $request ){
        DB::table('tb_bank')->where('id',$request->id)->update([
            'nama_bank'     => $request->nama_bank,
            'no_rekening'   => $request->no_rekening
        ]);

        return redirect('/Bank')->with('succes','Bank Berhasil di Ubah');
    }
}
