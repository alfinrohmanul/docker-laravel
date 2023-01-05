<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Exports\SupplierExport;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use DataTables;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\ActivityLog;

class SupplierController extends Controller
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
        $namasub="Data Supplier";

        $getbuton=getaccesbutton(4);

        return view('Supplier.Index', compact('menuku','namasub'))->with('butons',$getbuton);
    }

    function TableSupp(){
        $getbuton=getaccesbutton(3);

        $data = Supplier::where('no_supp','regexp','WHS')->get();
        return Datatables::of($data)
            ->addColumn('kode_supp', function ($data) {
                $akct="'".$data->kode_supp."'";
                $getbuton=getaccesbutton(4);
                $update = '<button type="button" data-id="'.$data->kode_supp.'" data-toggle="modal" data-target="#modal-edit" class="btn btn-warning btn-xs btn-edits" '.aktifubah($getbuton['ubah']).'><i class="fa fa-edit"></i></button> <button type="button" onclick="trash('.$akct .')" class="btn btn-danger btn-xs" '.aktifhapus($getbuton['hapus']).'><i class="fas fa-trash-alt"></i></button>';
                return $update;
            })
            ->rawColumns(['kode_supp'])
            ->make(true);
    }

    

    function SimpanSupp(Request $request){
        $menuku = "Master Data";
        $namasub="Data Supplier";

         $sp=generatecode('SP');

        Supplier::create(array(
            'kode_supp'     => $sp,
            'no_supp'       => 'S.WHS'.date('ymd').rand(10,100),
            'nama_supp'     => $request->nama_supp,
            'no_telp'       => $request->no_hp,
            'kota'          => $request->kota,
            'alamat'        => $request->alamat
            ));

            ActivityLog::create(array(
                'log_name'      => 'Buat Supplier',
                'keterangan'    => 'Supplier Baru' .'S.WHS'.date('ymd').rand(10,100),
                'id_user'       => Auth::user()->id
            ));
  
        }

        function SuppUpdate(Request $request){
            return Supplier::find($request->id);
        }

        function UpdateSupp(Request $request ){

            Supplier::where('no_supp',$request->no_supp)
            ->update(['nama_supp'   => $request->nama_supp,
                    'no_telp'       => $request->no_hp,
                    'kota'          => $request->kota,
                    'alamat'        => $request->alamat
                ]);

                ActivityLog::create(array(
                    'log_name'      => 'Ubah SUpplier',
                    'keterangan'    => 'Mengubah Supplier' .$request->no_supp,
                    'id_user'       => Auth::user()->id
                ));
        }

        public function exportSupp()
        {
            return Excel::download(new SupplierExport, 'Supplier.xlsx');
        }

        public function destroysupp($id)
        {
            $supp = Supplier::find($id);
            $supp->delete();

            ActivityLog::create(array(
                'log_name'      => 'Hpus SUpplier',
                'keterangan'    => 'Hapus Supplier' .$id,
                'id_user'       => Auth::user()->id
            ));
            return 'sukses';
        }
}
