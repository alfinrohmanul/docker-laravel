<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use DataTables;
use App\Models\Barang;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class DashboardController extends Controller
{
    public function __construct()
    {
        if (Auth::check()) {
            return redirect('Home');
        }else{
            return view('welcome');
        }
    }
    public function export_excel()
	{
		return Excel::download(new BarangExport, 'barang.xlsx');
	}
    public function index()
    {
        $getomzet=DB::select("SELECT SUM(total+pajak+pph-diskon)subtotal FROM tb_penjualan WHERE MONTH(tgl_penjualan)=MONTH(NOW())");
        $piutang=DB::select("SELECT SUM(total+pajak+pph-diskon-uang_dibayar)subtotal FROM tb_penjualan WHERE YEAR(tgl_penjualan)=YEAR(NOW()) AND status_trs=2");
        $penjualan=DB::select("SELECT SUM(total+pajak+pph-diskon)subtotal FROM tb_penjualan WHERE DATE(tgl_penjualan)=DATE(NOW())");
        $uangditerima=DB::select("SELECT SUM(debet_rp)subtotal FROM tb_d_jurnal WHERE DATE(tgl_dokumen)=DATE(NOW())");
        $menuku = "Dashboard";
        $namasub="Dashboard";
        return view('Home', compact('menuku','namasub'))
                ->with('omzet',$getomzet[0]->subtotal)
                ->with('piutang',$piutang[0]->subtotal)
                ->with('diterima',$uangditerima[0]->subtotal)
                ->with('penjualan',$penjualan[0]->subtotal);
    }

 function Profile(){
        $menuku = "Dashboard";
        $namasub="Dashboard";

        return view('Profile', compact('menuku','namasub'));
    }
    
    public function Pengguna(){

        $data = DB::table('users')
                    ->get();

        $menuku = "Master Data";
        $namasub="Data Pengguna";
        
        return view('Pengguna',compact('menuku','namasub'))->with('user', $data);
    }

    public function UsrCreate(){
        $menuku = "Master Data";
        $namasub="Data Pengguna";
        
        $data = DB::table('master_karyawans')
                    ->where('status','Aktif')
                    ->get();

        return view('UsrCreate',compact('menuku','namasub'))->with('karyawan', $data);
    }

    function access(Request $request){
        $id=$request->id;
        $idmenu=$request->idmenu;
        $idsub=$request->idsub;
        $aces=$request->aces;
		$cek=DB::select("SELECT ".$aces." FROM tb_access_menu where id_user='$id' and id_sub_menu='$idsub'");
		if($cek[0]->$aces=='Y'){
			$data="N";
		}else{
			$data="Y";
		}

        DB::update("update tb_access_menu set ".$aces ."='" .$data."' where id_user=".$id." and id_sub_menu=".$idsub);

        return $data;
        // echo "SELECT ".$aces." FROM tb_access_menu where id_user='$id' and id_menu='$idmenu'";
    }

    function createusermn(Request $request){
        $id=$request->nama_karyawan;
        $email=$request->email;
        $nama=$request->namakry;

        $hash_password_saya = Hash::make('wahanasatria');

        User::create(array(
            'name'      => $nama,
            'email'     => $email,
            'password'  => $hash_password_saya,
        ));
    
        return redirect()
            ->route('Pengguna')
            ->with('succes','Barang Berhasil di Tambah');
    }

    function privilage($id){
        $menuku = "Master Data";
        $namasub="Data Pengguna";
        $keyindex=$id;

        $cekvilage=DB::select("select id_user from tb_access_menu where id_user='$id' limit 1");
        
        if(empty($cekvilage)){
            DB::insert("INSERT INTO tb_access_menu(id_user,id_menu,id_sub_menu)
            SELECT '$id',id_menu_utama,id_sub FROM tb_sub_menu ORDER BY id_menu_utama ASC");
        }

        return view('Prvilage',compact('menuku','namasub','keyindex')); ;
    }
//MASTER BARANG
    public function DataItem(){
        $menuku = "Master Data";
        $namasub="Data Barang";
        $getbuton=getaccesbutton(2);
        return view('Item',compact('menuku','namasub'))->with('butons',$getbuton);
    }

    public function TableItem(){
        
        $data = Barang::where('itemfor','Wahana')->get();

        return Datatables::of($data)
            ->addColumn('kode_barang', function ($data) {
                $akct="'".$data->kode_barang."'";
                $getbuton=getaccesbutton(2);
                $update = '<a '.aktifubah($getbuton['ubah']).' type="button" href="ItmUpdate/'.$data->kode_barang.'" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a> <button type="button" onclick="trash('.$akct .')" class="btn btn-danger btn-xs" '.aktifhapus($getbuton['hapus']).'><i class="fas fa-trash-alt"></i></button>';
                return $update;
            })
            ->rawColumns(['kode_barang'])
            ->make(true);
    }

    function ItmCreate(){
        $menuku = "Master Data";
        $namasub="Data Barang";
        
        $data = DB::table('tb_kategori')
                    ->get();

        return view('ItmCreate',compact('menuku','namasub'))->with('kategori', $data);
        
    }

    function SaveItmCreate(Request $request){
        $menuku = "Master Data";
        $namasub="Data Barang";

        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute harus diisi minimal :min karakter ',
            'max' => ':attribute harus diisi maksimal :max karakter ',
        ];
        
        $namatri=[
            'no_barang'     => 'Nomer Barang',
            'nama_barang'   => 'Nama Barang',
            'satuan'        => 'Satuan Barang'
        ];

        $this->validate($request,[
            'no_barang'     => 'required|max:15',
            'nama_barang'   => 'required|max:35',
            'satuan'        => 'required'
         ],$messages,$namatri);
  

        Barang::create(array(
            'no_barang'     => $request->no_barang,
            'nama_barang'   => $request->nama_barang,
            'kategori'      => $request->kategori,
            'satuan'        => $request->satuan,
            'harga'         => str_replace('.', '', $request->harga),
            'is_ukuran'     => $request->is_ukuran,
            'hpp_barang'    => str_replace('.', '', $request->hpp_barang),
        ));

        return redirect()
                ->route('ItmCreate')
                ->with('succes','Barang Berhasil di Tambah');
    }

    function ItmUpdate($id){
        $menuku = "Master Data";
        $namasub="Data Barang";
        
        $kateg = DB::table('tb_kategori')
                    ->get();

        $data = DB::table('tb_barang')->where('kode_barang',$id)->get();

        return view('ItmUpdate',compact('menuku','namasub'))->with('barang', $data)->with('kategori',$kateg);
    }

    function UpdateBarang(Request $request){
        DB::table('tb_barang')->where('kode_barang',$request->id)->update([
            'nama_barang'   => $request->nama_barang,
            'satuan'        => $request->satuan,
            'kategori'      => $request->kategori,
            'harga'         => str_replace('.', '', $request->harga),
            'hpp_barang'    => str_replace('.', '', $request->hpp_barang),
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('/DataBarang');
    }

    public function destroybarang($id)
        {
        $barang = Barang::find($id);
        $barang->delete();
        return 'sukses';
        }
    
        function GetKaryawan($key){
            $karyawan = Karyawan::find($key);

            return $karyawan;
        }
        
        function Bantuan(){
                        $filename = 'Modul.pdf';
            $path = storage_path($filename);

            return Response::make(file_get_contents($path), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'"'
            ]);
        }
}


