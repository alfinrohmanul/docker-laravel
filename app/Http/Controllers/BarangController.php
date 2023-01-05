<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Exports\BarangExport;
use App\Exports\TemplateExport;
use App\Imports\BarangImport;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use DataTables;
use App\Models\Barang;
use App\Models\Akun;
use App\Models\Subkategori;
use App\Models\ActivityLog;


class BarangController extends Controller
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
        $namasub="Data Barang";
        $getbuton=getaccesbutton(3);
        return view('Barang/Index',compact('menuku','namasub'))->with('butons',$getbuton);
    }

    function ItmCreate(){
        $menuku = "Master Data";
        $namasub="Data Barang";
        // $getbuton=getaccesbutton(2);

        $group=DB::select("select * From tb_kategori where kategorifor='Wahana'");

        $akun=Akun::all();
        $subkateg=Subkategori::all();
        $detailbarang=Barang::all();
        return view('Barang/Create',compact('menuku','namasub'))
                    ->with('group',$group)
                    ->with('akun',$akun)
                    ->with('subkateg',$subkateg)
                    ->with('barang',$detailbarang);
    }

    function SaveItmCreate(Request $request){
        $menuku = "Master Data";
        $namasub="Data Item";

        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute harus diisi minimal :min karakter ',
            'max' => ':attribute harus diisi maksimal :max karakter ',
        ];
        
        $namatri=[
            'nama_barang'   => 'Nama Barang'
        ];

        $this->validate($request,[
            'nama_barang'   => 'required|max:35',
         ],$messages,$namatri);
  
        $kods=generatecode('BRG');
        $urutan=DB::select("SELECT IFNULL(COUNT(subkategori)+1,1)toal FROM tb_barang WHERE subkategori='A3'");
        Barang::create(array(
            'kode_barang'   => $kods,
            'no_barang'     => $request->grouping.'.'.$request->subkateg.'.0'.$urutan[0]->toal,
            'nama_barang'   => $request->nama_barang,
            'kategori'      => $request->grouping,
            'satuan'        => $request->satuan1,
            'satuan1'       => $request->satuan2,
            'hpp_barang'    => $request->hpp_barang,
            'marginset'     => $request->marginset,
            'subkategori'   => $request->subkateg,
            'itemfor'       => $request->fors
        ));
        toastr()->success('Data Tersimpan');
        return redirect('DataBarang');
    }

    public function TableBarang(){
        
        $data = Barang::where('itemfor','Wahana')->get();
        return Datatables::of($data)
            ->addColumn('kode_barang', function ($data) {
                $akct="'".$data->kode_barang."'";
                $getbuton=getaccesbutton(3);
                $update = '<a '.aktifubah($getbuton['ubah']).' type="button" href="EditView/'.$data->kode_barang.'" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a> <button type="button" onclick="trash('.$akct .')" class="btn btn-danger btn-xs" '.aktifhapus($getbuton['hapus']).'><i class="fas fa-trash-alt"></i></button>';
                return $update;
            })
            ->rawColumns(['kode_barang'])
            ->make(true);
    }

    function ImportBarang(Request $request){
            // validasi
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            // menangkap file excel
            $file = $request->file('file');

            // membuat nama file unik
            $nama_file = rand().$file->getClientOriginalName();

            // upload ke folder file_siswa di dalam folder public
            $file->move('filebarang',$nama_file);

            // import data
            Excel::import(new BarangImport, public_path('/filebarang/'.$nama_file));
            toastr()->success('Data Tersimpan');
            return redirect('/DataBarang');
            // return $file;
    }

    function EditView($key){
        $menuku = "Master Data";
        $namasub="Data Barang";
        $getbuton=getaccesbutton(2);

        // $barang=Barang::find($key);
        $barang=Barang::find($key);
        $detailbarang=Barang::all();
        $akun=Akun::all();
        $group=DB::select("select * From tb_kategori");
        return view('Barang/Update',compact('menuku','namasub'))
                ->with('butons',$getbuton)
                ->with('group',$group)
                ->with('akun',$akun)
                ->with('getbar',$detailbarang)
                ->with('barang',$barang);
                
    }

    public function export_excel()
	{
		return Excel::download(new BarangExport, 'barang.xlsx');
	}

    public function destroybarang($id)
        {
        $barang = Barang::find($id);

        ActivityLog::create(array(
            'log_name'      => 'Hapus',
            'keterangan'    => 'Hapus Barang '.$id,
            'id_user'       => Auth::user()->id
        ));

        $barang->delete();
        
        return 'sukses';
        }

    function SaveB(Request $request){

        DB::table('tb_barang')->where('kode_barang',$request->kode_barang)->update([
            'nama_barang'   => $request->nama_barang,
            'satuan'        => $request->satuan1,
            'satuan1'       => $request->satuan2,
            'hpp_barang'    => $request->hpp_barang,
            'itemfor'       => $request->fors,
            'marginset'     => $request->marginset,
            'kode_akun1'    => $request->kodeakun1,
            'kode_akun2'    => $request->kodeakun2
        ]);

        ActivityLog::create(array(
            'log_name'      => 'Update',
            'keterangan'    => 'Update Barang '.$request->no_barang,
            'id_user'       => Auth::user()->id
        ));

        toastr()->success('Data Tersimpan');
        return redirect('DataBarang');
    }

    public function Template()
    {
        return Excel::download(new TemplateExport(''), 'Template.xls');
    }
}
