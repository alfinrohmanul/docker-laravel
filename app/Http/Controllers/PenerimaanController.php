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
use App\Models\Penerimaan;
use App\Models\DetailPenerimaan;
use App\Models\ActivityLog;
use App\Models\Jurnal;

class PenerimaanController extends Controller
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
        $menuku = "Persediaan";
        $namasub="Penerimaan Barang";

        $getbuton=getaccesbutton(13);

        return view('Penerimaan.Index', compact('menuku','namasub'))->with('butons',$getbuton);
    }

    function TablePenerimaan(){
        $data = DB::select("SELECT a.*,nama_supp FROM tb_penerimaan_barang a
        LEFT OUTER JOIN tb_supplier b ON a.`kode_supplier`=b.`kode_supp` where id_cabang='7'
        GROUP BY a.`kode_penerimaan`");
        
        return Datatables::of($data)
        ->addColumn('nominal', function ($data) {
            $update = rupiahtampil($data->nominal);
            return $update;
        })
        ->rawColumns(['nominal'])
        ->make(true);
    }

    function CreatePenerimaan(){
        $menuku = "Persediaan";
        $namasub="Penerimaan Barang";
        $last = DB::table('tb_counter')
            ->where('id','PNM')
            ->get()
            ->toArray();
            $barang=Barang::where('itemfor','Adaya')->get();
        $countermu=DB::select("SELECT IFNULL(MAX(urut)+1,1) nomer FROM tb_penerimaan_barang WHERE DATE(tgl_masuk)=DATE(NOW())");
    
        $urut=$countermu[0]->nomer;

        $tgltrans = date('Y-m-d');
        $kodes=get_kos($urut);
        $counter=get_fj('0713',$kodes,$urut,$tgltrans);
        // $dtNow = date('Y-m-d H:i:s', time());

        $supp=Supplier::all();

        return view('Penerimaan.Create', compact('menuku','namasub','counter'))->with('supp',$supp)->with('barang',$barang);
    }

    function GetBarang(){
        $barang=Barang::where('itemfor','Adaya')->get();

        $status = "sukses";
        $message = "Data berhasil di tampilkan";
        $data = $barang->toArray();
        $code = 200;

        return response()->json([
            'data' => $data
        ], $code);
    }

    function addRowBarangMasuk(Request $request){
        $urutan = $request->urutan;
		$id_barang = $request->id_barang;
		$db = Barang::find($id_barang);

        $harsat=(int)$db->harga;

		$output = '';
		$output .= '<tr class="records" id="row' . $urutan . '">';

		$output .= '<td style="width: 30%;">
                        <input class="form-control  form-control-sm" type="text" id="nama" name="nama[]" autocomplete="off" value="' . $db['nama_barang'] . '" readonly>
                        <input class="form-control  form-control-sm" type="text" id="id" name="id[]" autocomplete="off" value="' . $db['kode_barang'] . '" hidden>
                    </td>';

		$output .= '<td style="width: 15%;">
                        <input class="form-control  form-control-sm" type="text" id="satuan" name="satuan[]" autocomplete="off" value="' . $db->satuan . '" readonly>
                    </td>';
        $output .= '<td style="width: 10%;">
                        <input class="form-control  form-control-sm text-center" onkeyup="sum(' . $urutan . ')" type="text" id="qty_masuk" name="qty_masuk[]" autocomplete="off" value="1">
                    </td>';
		$output .= '<td style="width: 15%;">
                        <input class="form-control  form-control-sm text-right" onkeyup="sum(' . $urutan . ')" type="text" id="vhrg_satuan" name="" value="' . $harsat . '" autocomplete="off" >
                        <input class="form-control  form-control-sm"  type="text" id="hrg_satuan" name="hrg_satuan[]"  autocomplete="off" hidden>
                    </td>';
		$output .= '<td style="width: 15%;">
                        <input class="form-control  form-control-sm text-right"  type="text" id="vhrg_total"  autocomplete="off" disabled>
                        <input class="form-control  form-control-sm"  type="text" id="hrg_total" name="hrg_total[]" autocomplete="off" hidden>
                    </td>';
		$output .= '<td style="width: 5%;">
                        <a class="btn btn-secondary btn-sm konfirmasi-hapus" href="#" data-toggle="tooltip" id="" title="Bayar" onclick="deleteRow(this)"><i class="fas fa-trash-alt"></i></i></a>
                    </td>';
		$output .= '</tr>';

		echo $output;
    }

    function convertHargaSatuan(Request $request)
	{
		$raw_harga = $request->hrg_satuan;
		$harga = str_replace('.', '', $raw_harga);
		echo $raw_harga;
	}

   
    function Simpan(Request $request){
        $gtkode=generatecode('PNM');
        $id_user=Auth::user()->id;
        $dtNow = date('Y-m-d H:i:s', time());
        $penerimaan     = $request->no_penerimaan;
        $suratjalan     = $request->no_sj;
        $kode_sup       = $request->nama_supp;
        $tglsj          = $request->tglsj;
        $namab          = $request->nama;
        $satuan         = $request->satuan;
        $qty1           = $request->qty_masuk;
        $hrg1           = $request->hrg_satuan;
        $total          = $request->hrg_total;

        $countermu=DB::select("SELECT IFNULL(MAX(urut)+1,1) nomer FROM tb_penerimaan_barang WHERE DATE(tgl_masuk)=DATE(NOW())");
        $urut=$countermu[0]->nomer;
        Penerimaan::create(array(
            'kode_penerimaan'   => $gtkode,
            'no_faktur'         => $penerimaan,
            'tgl_masuk'         => $dtNow,
            'no_sj'             => $suratjalan,
            'tgl_sj'            => $tglsj,
            'kode_supplier'     => $kode_sup,
            'id_user'           => $id_user,
            'status_dokumen'    => "Terbuka",
            'nominal'           => 0,
            'urut'              => $urut,
            'id_cabang'         => Auth::user()->id_cabang
        ));

        $kodebarang=$request->id;
        $n=0;
        $sutotal=0;
        foreach($kodebarang as $gtk)
        {
            DetailPenerimaan::create(array(
                'kode_penerimaan'   => $gtkode,
                'kode_barang'       => $gtk,
                'nama_barang'       => $namab[$n],
                'satuan1'           => $satuan[$n],
                'qty'               => $qty1[$n],
                'harga'             => $hrg1[$n],
                'total'             => $total[$n]
            ));
            $sutotal+=$total[$n];
            $n++;
            
        }

        //Pembuatan Jurnal Akutansi
        Jurnal::create(array(
            'kode_dokumen'      => $gtkode,
            'tgl_dokumen'       => $dtNow,
            'kode_akun'         => 'AKN0000000019',
            'debet_rp'          => $sutotal,
            'catatan'           => 'PERSEDIAAN BAHAN BAKU'
        ));

        Jurnal::create(array(
            'kode_dokumen'      => $gtkode,
            'tgl_dokumen'       => $dtNow,
            'kode_akun'         => 'AKN0000000047',
            'kredit_rp'         => $sutotal,
            'catatan'           => 'UTANG DAGANG ATAS ' .$penerimaan
        ));

        //Batas Cek
        DB::table('tb_penerimaan_barang')
              ->where('kode_penerimaan', $gtkode)
              ->update(['nominal' => $sutotal]);

        toastr()->success('Penerimaan Di Buat');

        ActivityLog::create(array(
            'log_name'      => 'Penerimaan',
            'keterangan'    => 'Membuat Penerimaan Barang '. $penerimaan,
            'id_user'       => Auth::user()->id
        )); 
        return redirect('PenerimaanBarang');
    }
    
    function Detail($id){
        $detail=DetailPenerimaan::where('kode_penerimaan', $id)->get();
        $output='';
        $output.='<table id="example1" class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>';
        foreach($detail as $dd){
            $output .= '<tr>
                    <td>'.$dd['nama_barang'].'</td>
                    <td>'.$dd['satuan1'].'</td>
                    <td>'.$dd['qty'].'</td>
                    <td style="text-align: right;">'.rupiahtampil($dd['harga']).'</td>
                    <td style="text-align: right;">'.rupiahtampil($dd['total']).'</td>
                  </tr>';
        }

        echo $output;
    }
}
