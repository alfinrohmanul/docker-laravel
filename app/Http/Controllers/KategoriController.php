<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use DataTables;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\ActivityLog;

class KategoriController extends Controller
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
        $namasub="Data Kategori";
        $getbuton=getaccesbutton(9);
        return view('Kategori.Index', compact('menuku','namasub'))->with('butons',$getbuton);
    }

    function TableKategori(){
        $data = Kategori::where('kategorifor','Wahana')->get();
        return Datatables::of($data)->make(true);
    }

    function CreateKategori(){
        $menuku = "Master Data";
        $namasub="Data Kategori";

        return view('Kategori.Create', compact('menuku','namasub'));
    }

    function SaveKategori(Request $request){
        Kategori::create($request->all());
        ActivityLog::create(array(
            'log_name'      => 'Tambah',
            'keterangan'    => 'Tambah Kategori '.$request->kategori,
            'id_user'       => Auth::user()->id
        ));
        return redirect()
                ->route('CreateKategori')
                ->with('succes','Kategori Berhasil di Tambah');
    }

    function KategoriUpdate($id){
        $menuku = "Master Data";
        $namasub="Data Kategori";

        $data = Kategori::find($id);

        return view('Kategori.Edit',compact('menuku','namasub'))->with('kategori', $data);
    }

    function UpdateKategori(Request $request){
        DB::table('tb_kategori')->where('id',$request->id)->update([
            'kategori'     => $request->kategori
        ]);
        
        ActivityLog::create(array(
            'log_name'      => 'Update',
            'keterangan'    => 'Update Kategori '.$request->kategori,
            'id_user'       => Auth::user()->id
        ));

        return redirect('/Kategori')->with('succes','Kategori Berhasil di Ubah');
    }

    public function destroy($id){
   
        Kategori::find($id)->delete($id);

        ActivityLog::create(array(
            'log_name'      => 'Hapus',
            'keterangan'    => 'Hapus Kategori '.$id,
            'id_user'       => Auth::user()->id
        ));

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    function store(Request $request){
        Subkategori::create($request->all());

    }

    function Getdata($id){
        $pendidikan = Subkategori::where('id_kategori', $id)->get();

        return response()->json([
            'pendidikans' => $pendidikan
        ]);
    }
}
