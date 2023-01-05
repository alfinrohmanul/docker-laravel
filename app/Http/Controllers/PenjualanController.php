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
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Detailpenjualan;
use App\Models\Pembayaran;
use App\Models\DetailPO;
use App\Models\PO;
use App\Models\ActivityLog;
use PDF;

class PenjualanController extends Controller
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
        $menuku = "Penjualan";
        $namasub="Penjualan";

        $data = Konsumen::where('no_konsumen','regexp','WHS|C')
        ->where('status_konsumen','Aktif')
        ->get();
        $last = DB::table('tb_counter')
            ->where('id','CST')
            ->get()
            ->toArray();

        $totalbelumdiambil=DB::select("SELECT COUNT(*) as totalambil FROM tb_penjualan WHERE status_dok='1'");
        $totalsudahdiambil=DB::select("SELECT COUNT(*) as totalambil FROM tb_penjualan WHERE status_dok='2'");
        $transhutang=DB::select("SELECT COUNT(*) as totalambil FROM tb_penjualan WHERE status_trs<'3'");
        $totalambil=$totalsudahdiambil[0]->totalambil;
        $hutang=$transhutang[0]->totalambil;
        return view('Penjualan.Index', compact('menuku','namasub','totalambil','hutang'))
                ->with('konsumen',$data)
                ->with('belumdiambil',$totalbelumdiambil);

    }

    function TransaksiBaru(Request $request){
        $menuku = "Penjualan";
        $namasub="Penjualan";

        $dtNow = date('Y-m-d H:i:s', time());

        // $data = Konsumen::latest()->get();
        $last = DB::table('tb_counter')
            ->where('id','CST')
            ->get()
            ->toArray();

        $lasttrs = DB::select("SELECT COUNT(kode_penjualan)+1 last_number FROM tb_penjualan WHERE DATE(tgl_penjualan)=DATE(NOW())");


        $countermu=DB::select("select udf_generateucodemt('TRS')kode");

        $primary='TRS' . date('Ymd') . '00' . $lasttrs[0]->last_number;
        $counter=$countermu[0]->kode;
        $id_user=Auth::user()->id;
        // $request->has('kode_konsumen') &&
        if (!empty($request->kode_konsumen)) {

        Penjualan::create(array(
                'kode_penjualan'    => $counter,
                'no_penjualan'      => $primary,
                'tgl_penjualan'     => $dtNow,
                'kode_konsumen'     => $request->kode_konsumen,
                'id_user'           => $id_user
                ));

        }else{

            $countercst=DB::select("select udf_generateucodemt('CST')kode");
            $countercst1='C' . date('ymd') .  rand(10,100);
            $primarycst=$countercst[0]->kode;

            Konsumen::create(array(
                'kode_konsumen'     => $primarycst,
                'no_konsumen'       => $countercst1,
                'nama_konsumen'     => $request->nama_konsumen,
                'no_hp'             => $request->no_hp,
                'kota'              => '.',
                'alamat'            => $request->alamat,
                'segmentasi'        => $request->segmentasi
                ));

            Penjualan::create(array(
                'kode_penjualan'    => $counter,
                'no_penjualan'      => $primary,
                'tgl_penjualan'     => $dtNow,
                'kode_konsumen'     => $primarycst,
                'id_user'           => $id_user
                    ));

        }

        // Jurnal::create(array(
        //     'kode_dokumen'      => $kode,
        //     'tgl_dokumen'       => $dtNow,
        //     'kode_akun'         => 'AKN0000000015',
        //     'debet_rp'          => $tots,
        //     'catatan'           => 'PIUTANG ATAS PENJUALAN '.$getfj
        // ));

        // Jurnal::create(array(
        //     'kode_dokumen'      => $kode,
        //     'tgl_dokumen'       => $dtNow,
        //     'kode_akun'         => 'AKN0000000069',
        //     'kredit_rp'         => $tots,
        //     'catatan'           => 'PENDAPATAN USAHA ATAS ' .$getfj
        // ));

        $transaksi = Penjualan::find($counter);
        $konsumen = Konsumen::find($transaksi->kode_konsumen);

        ActivityLog::create(array(
            'log_name'      => 'Transaksi',
            'keterangan'    => 'Membuat Transaksi '. $primary,
            'id_user'       => Auth::user()->id
        ));

        return redirect('Penjualan/Updtransaksi/'.$counter);
        // $this->Updtransaksi($primary);
    }

    public function Updtransaksi($counter){

        $menuku = "Penjualan";
        $namasub="Penjualan";

        $transaksi = Penjualan::find($counter);
        $konsumen = Konsumen::find($transaksi->kode_konsumen);

          return view('Penjualan.Baru', compact('menuku','namasub'))
                    ->with('no_transaksi',$transaksi)
                    ->with('datakonsumen',$konsumen);
    }
    function TableBarangjual(){

        $barang= Barang::where('itemfor','Wahana')->get();
        return Datatables::of($barang)
        ->addColumn('harga', function ($data) {
            // $akct="'".$data->id."'";
            $update = rupiahtampil($data->harga);
            return $update;
        })
        ->rawColumns(['harga'])
        ->make(true);

    }

    function GetKonsumen($key){
        $data = Konsumen::find($key);

        return $data;
    }

    function insertDetailTransaksi(Request $request){

        $getbarang=Barang::find($request->id_barang);

        Detailpenjualan::create(array(
            'kode_penjualan'    => $request->kode_penjualan,
            'id_barang'         => $request->id_barang,
            'nama_file'         => '-',
            'lebar'             => 100,
            'panjang'           => 100,
            'jumlah'            => 1,
            'harga'             => $getbarang->harga,
            'hpp'               => $getbarang->hpp_barang
                ));

        echo  $getbarang->hpp_barang;
    }

    function TampilkanTransaksiDetail($key){

        $data=DB::select("SELECT tb_d_penjualan.*,nama_barang,is_ukuran
        FROM tb_d_penjualan
        INNER JOIN tb_barang ON tb_d_penjualan.id_barang = tb_barang.kode_barang WHERE (kode_penjualan = '$key')");

        $output="";
        $output .= '<div class="overflow-auto" style="overflow-x:auto;">';
		$output .= '<table class="table" id="cartTable">
                        <thead>
                            <tr>
                                <th style="width:25%">Nama File</th>
                                <th style="width:15%">Nama Layanan</th>
                                <th style="width:10%">Panjang (cm)</th>
                                <th style="width:10%">Lebar (cm)</th>
                                <th style="width:10%">Jumlah Order(pcs)</th>
                                <th style="width:10%" class="text-right">Harga</th>
                                <th style="width:10%" class="text-right">HPP Total</th>
                                <th style="width:10%" class="text-right">Total Harga</th>
                                <th style="width:10%">Action</th>
                            </tr>
                        </thead><tbody id="tbKeranjang">';
                        $nmbr = 0;
        foreach ($data as $namadetail) {
            $nmbr = $nmbr + 1;
            if($namadetail->is_ukuran=="N"){
                $output .= '<tr class="records" id="row' . $nmbr . '">
                <td style="width:10%"> <textarea class=" form-control form-control-sm" onchange="updateNama(' . $nmbr . ')" name="" id="dtr_nama" style="text-align: left;" type="text" value=""> '.$namadetail->nama_file.'</textarea> </td>
                            <td class="pt-3">'.$namadetail->nama_barang.'<input class=" form-control form-control-sm" id="dtr_total" type="text" value="'.$namadetail->subtotal.'" hidden> <input class=" form-control form-control-sm" name="" id="dtr_id" type="text" value="'.$namadetail->id.'" hidden> <input id="dtr_satuan" type="text" value="'.$namadetail->is_ukuran.'" hidden> </td>
                            <td style="width:10%"> <input class=" form-control form-control-sm" onchange="sum(' . $nmbr . ')" name="" id="dtr_panjang" style="text-align: center;" type="text" value="'.$namadetail->panjang.'" hidden> </td>
                            <td style="width:10%"> <input class=" form-control form-control-sm" onchange="sum(' . $nmbr . ')" name="" id="dtr_lebar" style="text-align: center;" type="text" value="'.$namadetail->lebar.'" hidden> </td>
                            <td style="width:10%"> <input class=" form-control form-control-sm" onchange="sum(' . $nmbr . ')" name="" id="dtr_jumlah" style="text-align: center;" type="text" autocomplete="off" value="'.$namadetail->jumlah.'"> </td>
                            <td style="width:12%"> <input class=" form-control form-control-sm dtr-harga" onchange="sum(' . $nmbr . ')" name="" id="dtr_harga" style="text-align: right;" type="text" value="'.$namadetail->harga.'">  </td>
                            <td style="width:12%"> <input class=" form-control form-control-sm dtr-harga" onchange="sum(' . $nmbr . ')" name="" id="hpp_total" style="text-align: right;" type="text" value="'.$namadetail->hpp.'">  </td>
                            <td class="pt-3 dtr-total text-right" id="vdtr_total">'.$namadetail->subtotal.'</td>
                            <td> <a href="#" onclick="hapusKeranjang(' . $nmbr . ')" class="badge badge-danger btn_del' . $nmbr . '" data-detid="'.$namadetail->id.'" data-detnama="'.$namadetail->nama_barang.'">Hapus</a> </td>
                        </tr>';
            }else {
                $output .= '<tr class="records" id="row' . $nmbr . '">
                <td style="width:10%"> <textarea class=" form-control form-control-sm" onchange="updateNama(' . $nmbr . ')" name="" id="dtr_nama" style="text-align: left;" type="text" value="">'.$namadetail->nama_file.' </textarea> </td>
                            <td class="pt-3">'.$namadetail->nama_barang.'<input class=" form-control form-control-sm" id="dtr_total" type="text" value="'.$namadetail->subtotal.'" hidden> <input class=" form-control form-control-sm" name="" id="dtr_id" type="text" value="'.$namadetail->id.'" hidden> <input id="dtr_satuan" type="text" value="" hidden> </td>
                            <td style="width:10%"> <input class=" form-control form-control-sm" onchange="sum(' . $nmbr . ')" name="" id="dtr_panjang" style="text-align: center;" type="text" value="'.$namadetail->panjang.'"> </td>
                            <td style="width:10%"> <input class=" form-control form-control-sm" onchange="sum(' . $nmbr . ')" name="" id="dtr_lebar" style="text-align: center;" type="text" value="'.$namadetail->lebar.'"> </td>
                            <td style="width:10%"> <input class=" form-control form-control-sm" onchange="sum(' . $nmbr . ')" name="" id="dtr_jumlah" style="text-align: center;" type="text" autocomplete="off" value="'.$namadetail->jumlah.'"> </td>
                            <td style="width:12%"> <input class=" form-control form-control-sm dtr-harga" onchange="sum(' . $nmbr . ')" name="" id="dtr_harga" style="text-align: right;" type="text" value="'.$namadetail->harga.'">  </td>
                            <td style="width:12%"> <input class=" form-control form-control-sm dtr-harga" onchange="sum(' . $nmbr . ')" name="" id="hpp_total" style="text-align: right;" type="text" value="'.$namadetail->hpp.'">  </td>
                            <td class="pt-3 dtr-total text-right" id="vdtr_total">'.$namadetail->subtotal.'</td>
                            <td> <a href="#" onclick="hapusKeranjang(' . $nmbr . ')" class="badge badge-danger btn_del' . $nmbr . '" data-detid="'.$namadetail->id.'" data-detnama="'.$namadetail->nama_barang.'">Hapus</a> </td>
                        </tr>';
                        $output .= '</tbody>';
            }

            $output .= "<script>
            $(function() {
                $('.dtr-harga').priceFormat({
                    prefix: '',
                    centsLimit: 0,
                    thousandsSeparator: '.',
                });
            });
            $(function() {
                $('.dtr-total').priceFormat({
                    prefix: '',
                    centsLimit: 0,
                    thousandsSeparator: '.',
                });
            });
        </script>";
        }
        $output.='</tbody>';
        echo $output;
    }

    function hapusDetailTransaksi(Request $request){
        $detailtan = Detailpenjualan::find($request->det_id);
        $detailtan->delete();
        return 'sukses';
    }

    function updateNamaFileKeranjang(Request $request){
        DB::table('tb_d_penjualan')->where('id',$request->dtr_id)->update([
            'nama_file' => $request->dtr_nama
        ]);

        return $request->dtr_nama;
    }

    function actionUbahDetailTransaksi($kode_transaksi){
        $menuku = "Penjualan";
        $namasub="Penjualan";

        $masertransaski = Penjualan::find($kode_transaksi);

        $masterkonsumen = Konsumen::find($masertransaski->kode_konsumen);
        $detailrans = DB::select("SELECT tb_d_penjualan.*,nama_barang,is_ukuran
        FROM tb_d_penjualan
        INNER JOIN tb_barang ON tb_d_penjualan.id_barang = tb_barang.kode_barang WHERE (kode_penjualan = '$masertransaski->kode_penjualan')");

        $subtotal = 0;
		foreach ($detailrans as $dtr_trs) {
			$subtotal = $subtotal + $dtr_trs->subtotal;
		}

        DB::table('tb_penjualan')->where('kode_penjualan',$kode_transaksi)->update([
            'total'   => $subtotal
        ]);

        if ($masertransaski->status_trs == 1) {

            $r_belum='';
            $r_hutang='hidden';
            $r_lunas='hidden';

		} elseif ($masertransaski->status_trs == 2) {

            $r_belum='hidden';
            $r_hutang='';
            $r_lunas='hidden';

		} else {
            $r_belum='hidden';
            $r_hutang='hidden';
            $r_lunas='';
		}

        if($masertransaski->status_dok == 1){
            $keter='Belum Diambil';
        }else{
            $keter='Diambil';
        }

        if ($masertransaski->status_trs == 1) {
			$hutang_hidden = ' ';
		} else {
			$hutang_hidden = ' hidden';
		}

        // $pembayaran = Pembayaran::where('kode_doktransaksi', $kode_transaksi)->get();

        $pembayaran=DB::select("SELECT * FROM tb_d_pembayaran WHERE kode_doktransaksi='$kode_transaksi'");

        return view('Penjualan.UbahPenjualan', compact('menuku','namasub','subtotal','r_belum','r_hutang','r_lunas','keter','hutang_hidden'))
                ->with('detail_tr',$detailrans)
                ->with('master',$masertransaski)
                ->with('pembayaran',$pembayaran)
                ->with('masterkonsumen',$masterkonsumen);

    }

    function updatedatacart(Request $request){
        $dtr_harga=str_replace('.', '', $request->dtr_harga);
        $hpp_total=str_replace('.', '', $request->hpp_total);
        $detailtan = Detailpenjualan::find($request->dtr_id);

        $masbar=Barang::find($detailtan->id_barang);

        $harjul = $dtr_harga;

	if($masbar->is_ukuran=="Y"){
           $dtr_total = $request->dtr_panjang * $request->dtr_lebar / $harjul * $request->dtr_jumlah * $harjul;
        }else{
            $dtr_total=$harjul * $request->dtr_jumlah;
        }

        //Macet hitung an
        DB::table('tb_d_penjualan')->where('id',$request->dtr_id)->update([
            'panjang'   => $request->dtr_panjang,
            'lebar'     => $request->dtr_lebar,
            'jumlah'    => $request->dtr_jumlah,
            'harga'     => $harjul,
            'subtotal'  => $dtr_total,
            'hpp'       => $hpp_total
        ]);

        return $harjul;
    }

    function transaksiBelumDiambil($id){
        $menuku = "Penjualan";
        $namasub="Penjualan";

        return view('Penjualan.List', compact('menuku','namasub'));
    }
    function transaksiBelumLunas($id){
        $menuku = "Penjualan";
        $namasub="Penjualan";

        return view('Penjualan.Belumlunas', compact('menuku','namasub'));
    }
    function ListTransaksi($id){
        $data = DB::select("SELECT kode_penjualan,no_penjualan,tgl_penjualan,nama_konsumen,SUM(total-diskon+pajak+pph)total,
        IF(status_dok=1,'Belum Diambil','Sudah diambil')statustransaksi,
        IF(status_trs=1,'Belum Dibayar',IF(status_trs=2,'Hutang',IF(status_trs=3,'Lunas','')))statusdokumen FROM tb_penjualan a
        LEFT OUTER JOIN tb_konsumen b ON a.`kode_konsumen`=b.`kode_konsumen`
        WHERE status_dok=$id GROUP BY a.`kode_penjualan`");

        return Datatables::of($data)
        ->addColumn('total', function ($data) {
            // $akct="'".$data->id."'";
            $update = rupiahtampil($data->total);
            return $update;
        })
        ->rawColumns(['total'])
        ->make(true);

        return $data;
    }

    function AllPenjualan(){
        $data = DB::select("SELECT kode_penjualan,no_penjualan,tgl_penjualan,nama_konsumen,SUM(total-diskon+pajak+pph)total,uang_dibayar,SUM(total-diskon+pajak+pph-uang_dibayar)sisa,
        IF(status_dok=1,'Belum Diambil','Sudah diambil')statustransaksi,
        IF(status_trs=1,'Belum Dibayar',IF(status_trs=2,'Hutang',IF(status_trs=3,'Lunas','')))statusdokumen FROM tb_penjualan a
        LEFT OUTER JOIN tb_konsumen b ON a.`kode_konsumen`=b.`kode_konsumen` GROUP BY a.`kode_penjualan`");

        return Datatables::of($data)
        ->addColumn('total', function ($data) {
            $update = rupiahtampil($data->total);
            return $update;
        })
        ->addColumn('uang_dibayar', function ($data) {
            $update = rupiahtampil($data->uang_dibayar);
            return $update;
        })
        ->addColumn('sisa', function ($data) {
            $update = rupiahtampil($data->sisa);
            return $update;
        })
           ->addColumn('cetak', function ($data) {
            $update = $data->kode_penjualan;
            return "<a target='_blank' href='CetakSpk/$update' class='btn btn-sm btn-warning'><i class='fas fa-print'></i></a>";
        })
        ->rawColumns(['cetak'])
        ->make(true);

        return $data;
    }

    function ListTransaksiBelumlunas($id){
        $data = DB::select("SELECT kode_penjualan,no_penjualan,tgl_penjualan,nama_konsumen,SUM(total-diskon+pajak+pph)total,uang_dibayar,SUM(total-diskon+pajak+pph-uang_dibayar)sisa,
        IF(status_dok=1,'Belum Diambil','Sudah diambil')statustransaksi,
        IF(status_trs=1,'Belum Dibayar',IF(status_trs=2,'Hutang',IF(status_trs=3,'Lunas','')))statusdokumen FROM tb_penjualan a
        LEFT OUTER JOIN tb_konsumen b ON a.`kode_konsumen`=b.`kode_konsumen`
        WHERE status_trs=$id GROUP BY a.`kode_penjualan`");

        return Datatables::of($data)
        ->addColumn('total', function ($data) {
            $update = rupiahtampil($data->total);
            return $update;
        })
        ->addColumn('uang_dibayar', function ($data) {
            $update = rupiahtampil($data->uang_dibayar);
            return $update;
        })
        ->addColumn('sisa', function ($data) {
            $update = rupiahtampil($data->sisa);
            return $update;
        })
        ->rawColumns(['total'])
        ->make(true);

        return $data;
    }

    function detailTransaksi($kode_transaksi){

        $masertransaski = Penjualan::find($kode_transaksi);
        $masterkonsumen = Konsumen::find($masertransaski->kode_konsumen);

        $detailrans = DB::select("SELECT tb_d_penjualan.*,nama_barang,is_ukuran
        FROM tb_d_penjualan
        INNER JOIN tb_barang ON tb_d_penjualan.id_barang = tb_barang.kode_barang WHERE (kode_penjualan = '$masertransaski->kode_penjualan')");

        $output = '';
		$output .= '<div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="nama">Nama Pelanggan</label>
                                                <input type="text font-weight-bold" class="form-control uang_cash" id="uang_cash" name="uang_cash" value="' . $masterkonsumen->nama_konsumen . '" placeholder="0" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="nama">Nomor HP</label>
                                                <input type="text font-weight-bold" class="form-control uang_cash" id="uang_cash" name="uang_cash" value="' . $masterkonsumen->no_hp . '" placeholder="0" disabled>
                                            </div>
                                        </div>
                                    </div>';
		$output .= '<div class="row">
                                <div class="col-lg-12">
                                    <div class="overflow-auto" style="overflow-x:auto;">

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Layanan</th>
                                                <th>Nama File</th>
                                                <th>Panjang</th>
                                                <th>Lebar</th>
                                                <th style="width: 5%;">Jumlah Cetak(pcs)</th>
                                                <th>Harga Satuan</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>';

		$no = 0;
		foreach ($detailrans as $dtr) {
			$no = $no + 1;
			if($dtr->is_ukuran=="Y"){
                $panjang =$dtr->panjang;
				$lebar = $dtr->lebar;
            }else {
				$panjang = '-';
				$lebar = '-';
			}

			$output .= '                    <tr>
                                            <td> ' . $no . '</td>
                                            <td> ' . $dtr->nama_barang. '</td>
                                            <td> ' . $dtr->nama_file . '</td>
                                            <td class="text-center"> ' . $panjang . '</td>
                                            <td class="text-center"> ' . $lebar . '</td>
                                            <td class="text-center"> ' . $dtr->jumlah . '</td>
                                            <td class="text-right"> ' . rupiahtampil($dtr->harga)  . '</td>
                                            <td class="text-right"> ' . rupiahtampil($dtr->subtotal)  . '</td>
                                        </tr>';
		}
		$output .= '        </table></div>
                                </div>';
		if ($masertransaski->status_trs != 1) {
			$output .= ' <div class="col-lg-12">

                                    <a href="' . url("Penjualan/actionUbahDetailTransaksi/") .'/' . $masertransaski->kode_penjualan . '" type="button" class="ml-3 btn btn-success float-right">Detail Transaksi</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

                            </div>';
		} else {
			$output .= ' <div class="col-lg-12">
            <a href="' . url("Penjualan/actionUbahDetailTransaksi/").'/' . $masertransaski->kode_penjualan . '" type="button"  class="ml-3 btn btn-success float-right">Proses Pembayaran</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

                            </div>';
		}

		$output .= '</div>';

		return $output;
    }

    function actionUbahPembayaran($key,Request $request){
        $diskon=$request->diskon_status;
        $pajak=str_replace('.', '', $request->ppnnominal);
        $pph=str_replace('.', '', $request->pphnominal);
        $dibayarkan=str_replace('.', '',$request->nom_bayar);
        $dikonnominal=str_replace('.', '',$request->diskon);
        $keterangan=$request->keterangan;
        $tipe_bayar=$request->tipe_bayar;
        $tipebayar=$request->jenis_bayar;
        $termin=$request->tempo;
        $bank=$request->bank;
        // $diskon_status = $request->diskon;

        // //Batas Deteksi
        Penjualan::where('kode_penjualan', $key)
                ->update([
                    'tr_diskon_status' => $diskon,
                    'pajak'            => $pajak,
                    'diskon'           => $dikonnominal,
                    'pph'              => $pph,
                    'uang_dibayar'     => $dibayarkan,
                    'kode_pembayaran'  => $tipebayar,
                    'keterangan'       => $keterangan,
                    'bank'             => $bank,
                    'tipe_bayar'       => $tipe_bayar,
                    'termin'           => $termin
                ]);

        //Proses Pengecekan
        $masertransaski = Penjualan::find($key);

        if ($diskon == 1) {
            if(strlen($dikonnominal)<3){
                $diskonrup = $dikonnominal * $masertransaski->total / 100;
            }else{
                $diskonrup=$dikonnominal;
            }
		}else{
            $diskonrup=$dikonnominal;
        }

        //Proses Validasi Kelunasan
        $dpp_total = $masertransaski->total - $masertransaski->diskon;
        $ppn_nom = $masertransaski->pajak;
        $grand_total = $dpp_total + $ppn_nom;

        if($masertransaski->uang_dibayar < $grand_total){
            //Jika kurang maka tetap hutang
            $status_trs= 2;
        }else{
            $status_trs= 3;
        }

        // var_dump($ppn_nom);
        DB::table('tb_penjualan')
              ->where('kode_penjualan', $key)
              ->update([
                  'status_trs' => $status_trs,
                  'diskon'     => $diskonrup
            ]);

        // if($masertransaski->status_trs==3){
        //     echo "lunas";
        // }else{
        //     echo "hutang";
        // }
        return redirect('Penjualan/actionUbahDetailTransaksi/'.$key);
    }

    function actionHutang($id){
        DB::table('tb_penjualan')
              ->where('kode_penjualan', $id)
              ->update(['status_trs' => 2]);

              return redirect('Penjualan/actionUbahDetailTransaksi/'.$id);
    }

    function actionAmbil($key){
        $dtNow = date('Y-m-d H:i:s', time());

        DB::table('tb_penjualan')
        ->where('kode_penjualan', $key)
        ->update([
            'status_dok'        => 2,
            'tr_tgl_selesai'    => $dtNow
    ]);

        return redirect('Penjualan/actionUbahDetailTransaksi/'.$key);

    }

    function printNotaBesar($key){
        $data['master']=Penjualan::find($key);
        $data['cust']=Konsumen::find($data['master']['kode_konsumen']);
        $data['detail'] = DB::select("SELECT tb_d_penjualan.*,nama_barang,satuan,is_ukuran
        FROM tb_d_penjualan
        INNER JOIN tb_barang ON tb_d_penjualan.id_barang = tb_barang.kode_barang WHERE (kode_penjualan = '$key')");



        $headers = [
            'Content-Type' => 'application/pdf'
        ];
        $pdf = PDF::loadView('Penjualan.Nota', $data);
        $pdf->setPaper('A5', 'landscape');
        return $pdf->stream();
    }

    function printNotaKecil($key){

        $data['master']=Penjualan::find($key);
        $data['cust']=Konsumen::find($data['master']['kode_konsumen']);
        $data['detail'] = DB::select("SELECT tb_d_penjualan.*,nama_barang,is_ukuran
        FROM tb_d_penjualan
        INNER JOIN tb_barang ON tb_d_penjualan.id_barang = tb_barang.kode_barang WHERE (kode_penjualan = '$key')");

        $headers = [
            'Content-Type' => 'application/pdf'
        ];
        $pdf = PDF::loadView('Penjualan.Notatrans', $data);
        $pdf->setPaper('A5', 'landscape');
        return $pdf->stream();
    }

    function GetPO(){
        $data = DB::select("SELECT a.*,nama_cabang,nama_lengkap FROM tb_po a
        LEFT OUTER JOIN master_cabangs b ON a.`id_cabang`=b.`id`
        LEFT OUTER JOIN master_karyawans c ON a.`id_user`=c.`id`");
        return Datatables::of($data)->make(true);

    }

    function addRowBarangKeluar(Request $request){
        $urutan = $request->urutan;
		$id_barang = $request->id_barang;
		$db = Barang::find($id_barang);

		$hrg_satuan = $db['hpp_barang'];

		$output = '';
		$output .= '<tr class="records" id="row' . $urutan . '">';

		$output .= '<td style="width: 40%;">
                        <input value="' . $db->nama_barang . '" class="form-control  form-control-sm" type="text" id="nama" name="nama[]" autocomplete="off"  readonly>
                        <input value="' . $db->id . '"class="form-control  form-control-sm" type="text" id="id" name="kode_barang[]" autocomplete="off"  hidden>
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
                        <input value="' . $hrg_satuan . '" class="form-control  form-control-sm text-right hrg-sat" type="text" id="vhrg_satuan" autocomplete="off" disabled>
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
}
