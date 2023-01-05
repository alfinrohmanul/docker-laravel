<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\Barang;
use App\Models\PO;
use App\Models\DetailPO;
use App\Models\ActivityLog;

class PermintaanController extends Controller
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
        $menuku = "Penjualan";
        $namasub="Permintaan Order";
        $getbuton=getaccesbutton(18);
        return view('PO/Index', compact('menuku','namasub'))->with('butons',$getbuton);
    }

    function Baru(){
        $menuku = "Penjualan";
        $namasub="Permintaan Order";
        $getbuton=getaccesbutton(18);
        $barang=Barang::where('itemfor','Adaya')->get();
        //Generate
        // $kode=generatecode('PO');
        $countermu=DB::select("SELECT IFNULL(MAX(urut)+1,1) nomer FROM tb_po WHERE DATE(tgl_po)=DATE(NOW())");
        $urut=$countermu[0]->nomer;

        $tgltrans = date('Y-m-d');
        $kodes=get_kos($urut);
        $getfj=get_fj('0018',$kodes,$urut,$tgltrans);
        $dtNow = date('Y-m-d H:i:s', time());
        //Batas
        return view('PO/Baru', compact('menuku','namasub','getfj'))
                ->with('barang',$barang)
                ->with('butons',$getbuton);
    }

    function StoreProses(Request $request){
        $id_user=Auth::user()->id;

         $kode=generatecode('PO');
         $countermu=DB::select("SELECT IFNULL(MAX(urut)+1,1) nomer FROM tb_po WHERE DATE(tgl_po)=DATE(NOW())");
         $urut=$countermu[0]->nomer;

         $tgltrans = date('Y-m-d');
         $kodes=get_kos($urut);
         $getfj=get_fj('0718',$kodes,$urut,$tgltrans);
         $dtNow = date('Y-m-d H:i:s', time());
         
         PO::create(array(
            'kode_po'       => $kode,
            'tgl_po'        => $dtNow,
            'id_user'       => $id_user,
            'no_po'         => $getfj,
            'keterangan'    => $request->keterangan,
            'status'        => 'Terbuka',
            'urut'          => $urut,
            'fob'           => $request->via,
            'tgl_kirim'     => $request->tgl_po,
            'id_cabang'     => Auth::user()->id_cabang,
            'alamat_panjang'=> $request->alamat
         ));


        $kodebarang=$request->kode_barang;

        $n=0;

        foreach($kodebarang as $beta)
        {
           DetailPO::create(array(
               'kode_po'      => $kode,
               'id'            => $n,
               'kode_barang'   => $beta,
               'no_barang'     => $request->no_barang[$n],
               'nama_barang'   => $request->nama[$n],
               'satuan'        => $request->satuan[$n],
               'qty_pesan'     => $request->qty[$n],
               'harga'         => $request->hrg_satuan[$n]
           ));
           $n++; 
        }

        ActivityLog::create(array(
            'log_name'      => 'Penjualan',
            'keterangan'    => 'Membuat PO Barang '. $getfj,
            'id_user'       => Auth::user()->id
        )); 

        toastr()->success('PO Di Buat');

        return redirect('PermintaanOrder');
    }
    
    function addRowBarangKeluar(Request $request){
        $urutan = $request->urutan;
		$id_barang = $request->id_barang;
		$db = Barang::find($id_barang);

		// $hrg_satuan = ((int)$db->hpp_barang*(int)$db->marginset)+(int)$db->hpp_barang;
		$hargamargin = (int)$db->marginset/100*(int)$db->hpp_barang;
        $hrg_satuan = (int)$db->hpp_barang+$hargamargin;

		$output = '';
		$output .= '<tr class="records" id="row' . $urutan . '">';

		$output .= '<td style="width: 40%;">
                        <input value="' . $db->nama_barang . '" class="form-control  form-control-sm" type="text" id="nama" name="nama[]" autocomplete="off"  readonly>
                        <input value="' . $db->kode_barang . '"class="form-control  form-control-sm" type="text" id="id" name="kode_barang[]" autocomplete="off"  hidden>
                        <input value="' . $db->no_barang . '"class="form-control  form-control-sm" type="text" id="no" name="no_barang[]" autocomplete="off"  hidden>
                    </td>';

		$output .= '<td style="width: 10%;">
                        <input class="form-control form-control-sm text-center" onkeyup="sum(' . $urutan . ')" type="text" id="qty" name="qty[]" autocomplete="off" value="1">
                    </td>';
		$output .= '<td style="width: 15%;">
                        <input value="' . $db->satuan . '" class="form-control  form-control-sm" type="text" autocomplete="off"  disabled>
                        <input value="' . $db->satuan . '" class="form-control  form-control-sm" type="text" id="satuan" name="satuan[]" autocomplete="off" hidden>
                    </td>';
		$output .= '<td style="width: 15%;">
                        <input value="' . $hrg_satuan . '" class="form-control  form-control-sm text-right hrg-sat" type="text" id="vhrg_satuan" autocomplete="off" readonly>
                        <input value="' . $hrg_satuan . '" class="form-control  form-control-sm"  type="text" id="hrg_satuan" name="hrg_satuan[]"  autocomplete="off" hidden>
                    </td>';
		$output .= '<td style="width: 15%;">
                        <input class="form-control  form-control-sm text-right"  type="text" id="vhrg_total"  autocomplete="off" disabled>
                        <input class="form-control  form-control-sm"  type="text" id="hrg_total" name="hrg_total[]" autocomplete="off" hidden>
                    </td>';
		$output .= '<td style="width: 5%;">
                        <a class="btn btn-secondary btn-sm konfirmasi-hapus" href="#" data-toggle="tooltip" id="" title="Bayar" onclick="deleteRow(this)"><i class="fas fa-trash-alt"></i></i></a>
                    </td>';
		$output .= '</tr>';
		$output .= "";
		echo $output;
    }

    function EditPo($id){
        $menuku = "Penjualan";
        $namasub="Permintaan Order";
        $getbuton=getaccesbutton(18);

        $master=PO::find($id);
        $detail=DetailPO::find($id);
        $barang=Barang::where('itemfor','Adaya')->get();
        return view('PO/Edit', compact('menuku','namasub'))
                ->with('barang',$barang)
                ->with('master',$master);
    }

    function UpdateProses(Request $request){
        
        DB::table('tb_po')->where('kode_po',$request->kode_po)->update([
            'alamat_panjang'=> $request->alamat,
            'keterangan'    => $request->keterangan,
            'fob'           => $request->via,
            'tgl_kirim'     => $request->tgl_po
        ]);

        $kodebarang=$request->kode_barang;

        $n=0;

        DB::table('tb_d_po')->where('kode_po', $request->kode_po)->delete();

        foreach($kodebarang as $beta)
        {
           DetailPO::create(array(
               'kode_po'       => $request->kode_po,
               'id'            => $n,
               'kode_barang'   => $beta,
               'no_barang'     => $request->no_barang[$n],
               'nama_barang'   => $request->nama[$n],
               'satuan'        => $request->satuan[$n],
               'qty_pesan'     => $request->qty[$n],
               'harga'         => $request->hrg_satuan[$n]
           ));
        
           $n++; 
        }
        // return $kodebarang;
        ActivityLog::create(array(
            'log_name'      => 'Penjualan',
            'keterangan'    => 'Membuat PO Barang '. $request->no_po,
            'id_user'       => Auth::user()->id
        )); 

        toastr()->success('merubah PO '.$request->no_po);

        return redirect('PermintaanOrder');
    }

    function DataDetail($id){
        $datapodetail = DetailPO::where('kode_po', $id)->get();

        return response()->json([
            'detailpo' => $datapodetail
        ]);
    }

    function GetPO(){
        $data = DB::select("SELECT a.*,nama_cabang,nama_lengkap FROM tb_po a
        LEFT OUTER JOIN master_cabangs b ON a.`id_cabang`=b.`id`
        LEFT OUTER JOIN master_karyawans c ON a.`id_user`=c.`id`
        where id_cabang='7'");
        return Datatables::of($data)->make(true);

    }
}
