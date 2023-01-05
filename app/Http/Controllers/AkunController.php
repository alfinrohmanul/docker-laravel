<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use DataTables;
use App\Models\Akun;

class AkunController extends Controller
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
        $namasub="Data Akun";
        $getbuton=getaccesbutton(7);

        return view('Akun.Index', compact('menuku','namasub'))->with('butons',$getbuton);

        // echo $getbuton['baru'];
    }

    function TableAkun(){
        // $data = Akun::latest()->get();
        $data = DB::select("SELECT a.*,b.nama_akun `akuninduk` FROM tb_akun a
        JOIN tb_akun b ON a.`akuninduk`=b.`kode_akun`");
        return Datatables::of($data)->make(true);
    }

    function AkunCreate(){
        $menuku = "Master Data";
        $namasub="Data Akun";
        $last = DB::table('tb_counter')
            ->where('id','AKN')
            ->get()
            ->toArray();

        $countermu=DB::select("select udf_generateucodemt('AKN')kode");
        
        $counter='AKN' . date('md') . '00' . $last[0]->last_number;
        $primary=$countermu[0]->kode;

        return view('Akun.Create', compact('menuku','namasub','counter','primary'));
    }

    function SaveAkun(Request $request){
        $menuku = "Master Data";
        $namasub="Data Akun";

        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute harus diisi minimal :min karakter ',
            'max' => ':attribute harus diisi maksimal :max karakter ',
        ];
        
        $namatri=[
            'kode_akun'     => '',
            'no_akun'       => 'Nomer Akun',
            'nama_akun'     => 'Nama Akun',
            'keterangan'    => 'Keterangan',
            'tipe'          => 'Tipe'
        ];

        $this->validate($request,[
            'kode_akun'     => '',
            'no_akun'       => 'required|max:15',
            'nama_akun'     => 'required|max:35',
            'keterangan'    => 'required',
            'tipe'          => 'required',
            'status'        => 'required',
         ],$messages,$namatri);

         Akun::create($request->all());

        return redirect()
                ->route('AkunCreate')
                ->with('succes','Akun Berhasil di Tambah');
    }

    function AkunUpdate($id){
        $menuku = "Master Data";
        $namasub="Data Akun";

        $data = Akun::find($id);

        return view('Akun.Edit',compact('menuku','namasub'))->with('akun', $data);
    }

    function UpdateAkun(){
        DB::table('tb_akun')->where('kode_akun',$request->kode_akun)->update([
            'nama_akun'     => $request->nama_akun,
            'keterangan'    => $request->keterangan,
            'tipe'          => $request->tipe,
            'status'        => $request->status
        ]);

        return redirect('/Konsumen')->with('succes','Konsumen Berhasil di Ubah');
    }

    public function destroyakun($id)
    {
    $barang = Akun::find($id);
    $barang->delete();
    return 'sukses';
    }

}
