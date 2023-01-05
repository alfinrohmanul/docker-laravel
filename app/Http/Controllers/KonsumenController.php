<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use DataTables;
use App\Models\Konsumen;
use App\Models\ActivityLog;
use App\Exports\KonsumenExport;
use Maatwebsite\Excel\Facades\Excel;

class KonsumenController extends Controller
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
        $namasub="Data Konsumen";
        $getbuton=getaccesbutton(5);
        return view('Konsumen.Index', compact('menuku','namasub'))->with('butons',$getbuton);
    }

    function TableCustomer(){
        $data = Konsumen::where('no_konsumen','regexp','WHS|C')->get();
        return Datatables::of($data)
        ->addColumn('status_konsumen', function ($data) {
            if($data->status_konsumen=='Aktif'){
                $stt='checked';
            }else{
                $stt='';
            }
            $update = '<td class="text-center">
            <div class="custom-control custom-switch custom-switch-on-success">
                                            <input
                                                type="checkbox"
                                                name="status"
                                                class="custom-control-input"
                                                id="status_'.$data->kode_konsumen.'"
                                                data-id="'.$data->kode_konsumen.'"
                                                '.$stt.'>
                                            <label class="custom-control-label" for="status_'.$data->kode_konsumen.'"></label>
                                        </div>
                                        <span class="status_title_'.$data->kode_konsumen.'" style="font-size: 12px;">'.$data->status_konsumen.'</span>
                                    </td>';
            return $update;
        })
        ->rawColumns(['status_konsumen'])
        ->make(true);
    }

    function CustCreate(){
        $menuku = "Master Data";
        $namasub="Data Konsumen";

        $counter='C' . date('ymd') . rand(10,100);


        return view('Konsumen.Create', compact('menuku','namasub','counter'));
    }

    function SaveKonsumen(Request $request){
        $menuku = "Master Data";
        $namasub="Data Konsumen";

        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute harus diisi minimal :min karakter ',
            'max' => ':attribute harus diisi maksimal :max karakter ',
        ];
        
        $namatri=[
            'kode_konsumen' => '',
            'no_konsumen'   => 'Nomer Konsumen',
            'nama_konsumen' => 'Nama Konsumen',
            'no_hp'     => 'No Telp',
            'kota'      => 'Kota',
            'alamat'    => 'Alamat'
        ];

        $this->validate($request,[
            'kode_konsumen'     => '',
            'no_konsumen'       => 'required|max:15',
            'nama_konsumen'     => 'required|max:35',
            'no_hp'             => 'required|max:13|min:10',
            'kota'              => 'required',
            'alamat'            => 'required',
         ],$messages,$namatri);

         $kode=generatecode('CST');
         Konsumen::create(array(
            'kode_konsumen'     => $kode,
            'no_konsumen'       => $request->no_konsumen,
            'nama_konsumen'     => $request->nama_konsumen,
            'no_hp'             => $request->no_hp,
            'kota'              => $request->kota,
            'alamat'            => $request->alamat,
            'segmentasi'        => $request->segmentasi
         ));

         toastr()->success('Konsumen Berhasil Di tambahkan');

         ActivityLog::create(array(
            'log_name'      => 'Konsumen',
            'keterangan'    => 'Membuat Konsumen '. $request->no_konsumen,
            'id_user'       => Auth::user()->id
        )); 
        return redirect('Konsumen');
    }

    function Custupdate($id){
        $menuku = "Master Data";
        $namasub="Data Konsumen";

        $data = DB::table('tb_konsumen')->where('kode_konsumen',$id)->get();

        return view('Konsumen.Edit',compact('menuku','namasub'))->with('konsumen', $data);
    }

    function UpdatKonsumen(Request $request ){
        DB::table('tb_konsumen')->where('kode_konsumen',$request->kode_konsumen)->update([
            'nama_konsumen' => $request->nama_konsumen,
            'no_hp'         => $request->no_hp,
            'kota'          => $request->kota,
            'alamat'        => $request->alamat,
            'segmentasi'    => $request->segmentasi
        ]);

        ActivityLog::create(array(
            'log_name'      => 'Konsumen',
            'keterangan'    => 'Mengubah Konsumen '. $request->no_konsumen,
            'id_user'       => Auth::user()->id
        )); 
        toastr()->success('Konsumen Berhasil Di Ubah');
        return redirect('/Konsumen');
    }

    function Exkonsumen(){
        return Excel::download(new KonsumenExport, 'Konsumen.xlsx');
    }

    public function destroy($id){
   
        Konsumen::find($id)->delete($id);

        ActivityLog::create(array(
            'log_name'      => 'Hapus',
            'keterangan'    => 'Hapus Konsumen '.$id,
            'id_user'       => Auth::user()->id
        ));

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function ubahStatus(Request $request)
    {
        DB::table('tb_konsumen')->where('kode_konsumen',$request->id)->update([
            'status_konsumen' => $request->status
        ]);


        ActivityLog::create(array(
            'log_name'      => 'Konsumen',
            'keterangan'    => 'Mengubah Konsumen '. $request->no_konsumen,
            'id_user'       => Auth::user()->id
        )); 

        return response()->json([
            'status' => 'true',
            'id' => $request->id,
            'title' => $request->status
        ]);
    }
}
