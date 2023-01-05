<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Exports\LaporanExport;
use App\Exports\DetailExport;
use App\Exports\PiutangExport;
use App\Exports\KasExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Penjualan;
use App\Models\Keuangan;
use App\Models\Konsumen;
use DataTables;
use PDF;

class LaporanController extends Controller
{
    public function __construct()
    {
        if (Auth::check()) {
            return redirect('Home');
        }else{
            return view('welcome');
        }
    }

    function Laporancetak(){
        $menuku = "Laporan";
        $namasub="Laporan Cetak";
        $datakasir=DB::select("SELECT * FROM users WHERE id IN(SELECT DISTINCT id_user FROM tb_penjualan)");
        $segmen=DB::select("SELECT DISTINCT segmentasi FROM tb_konsumen WHERE segmentasi IS NOT NULL");
        return view('Laporan.Laporan', compact('menuku','namasub'))
                ->with('segmen',$segmen)
                ->with('kasir',$datakasir);

    }

    function exlaporan($a,$b,$c){
        // return Excel::download(new TemplateExport(''), 'Template.xls'); 
        return Excel::download(new LaporanExport($a,$b,$c), 'Laporan'.$a.'-'.$b.'.xlsx');
    }

    function exlaporandetail($a,$b,$c){
            
        $td=date('d-M-Y');
        return Excel::download(new DetailExport($a,$b,$c), 'DetailLaporan '.$td.'.xlsx');
        
    }

    function expiutang(Request $request){
		$a=$request->awalu;
		$b=$request->akhiru;
		$c=$request->segmentasi;
            
		$output=Excel::download(new PiutangExport($a,$b,$c), 'Piutang '.$a.'.xlsx');
		// response()->json($response);
		return $output;
    }
    function Penerimaan($a,$b){
            
        return Excel::download(new KasExport($a,$b), 'Kas '.$a.'.xlsx');
    }

    function tampilDataTransaksi(Request $request){
        $a=date('Y-m-d');
        $iduser=$request->kasir;
        $tgl1=$request->tgl1;
        $tgl2=$request->tgl2;
        $sift=$request->shift;
        $status=$request->status;
        $segmen=$request->segment;

        if($sift=='1'){
            $jam1='08:00:01';
            $jam2='15:59:59';
        }else if($sift=='2'){
            $jam1='16:00:01';
            $jam2='21:59:59';
        }else{
            $jam1='00:00:01';
            $jam2='23:59:59';
        }

        if($iduser=='-'){
            $hariini=DB::select("SELECT SUM(total-diskon+pajak+pph)totals,SUM(uang_dibayar)uangdibayar FROM tb_penjualan a
            LEFT OUTER JOIN tb_konsumen b ON a.`kode_konsumen`=b.`kode_konsumen` WHERE  tgl_penjualan BETWEEN '$tgl1 $jam1' and '$tgl2 $jam2' and status_trs regexp '$status' AND b.`segmentasi` regexp '$segmen'");
            $semua = DB::select("SELECT kode_penjualan,no_penjualan,tgl_penjualan,IFNULL(nama_sales,'Tidak ada')namas,pajak,pph,diskon,nama_konsumen,total,SUM(total-diskon+pajak+pph)totals,uang_dibayar,SUM(total-diskon+pajak+pph-uang_dibayar)sisa FROM tb_penjualan a
            LEFT OUTER JOIN tb_konsumen b ON a.`kode_konsumen`=b.`kode_konsumen` 
            LEFT OUTER JOIN tb_sales c ON a.`kode_sales`=c.`kode_sales`
            where a.tgl_penjualan between '$tgl1 $jam1' and '$tgl2 $jam2' and status_trs regexp '$status' AND b.`segmentasi` regexp '$segmen'
            GROUP BY a.`kode_penjualan`");
        }else{
            $hariini=DB::select("SELECT SUM(total-diskon+pajak+pph)totals,SUM(uang_dibayar)uangdibayar FROM tb_penjualan a
            LEFT OUTER JOIN tb_konsumen b ON a.`kode_konsumen`=b.`kode_konsumen` WHERE id_user='$iduser' AND tgl_penjualan BETWEEN '$tgl1 $jam1' and '$tgl2 $jam2' AND b.`segmentasi` regexp '$segmen' and status_trs regexp '$status'");
            $semua = DB::select("SELECT kode_penjualan,no_penjualan,tgl_penjualan,IFNULL(nama_sales,'Tidak ada')namas,pajak,pph,diskon,nama_konsumen,total,SUM(total-diskon+pajak+pph)totals,uang_dibayar,SUM(total-diskon+pajak+pph-uang_dibayar)sisa FROM tb_penjualan a
            LEFT OUTER JOIN tb_konsumen b ON a.`kode_konsumen`=b.`kode_konsumen` 
            LEFT OUTER JOIN tb_sales c ON a.`kode_sales`=c.`kode_sales`
            WHERE a.`id_user`=$iduser and a.tgl_penjualan between '$tgl1 $jam1' and '$tgl2 $jam2' and status_trs regexp '$status' AND b.`segmentasi` regexp '$segmen'
            GROUP BY a.`kode_penjualan`");
        }

        $output = '';
        $output .= '<div class="col-lg-12">
                                        <div class="callout callout-info py-1">
                                            <h5 class="mb-1 font-weight-bold">Total Omset :  '.rupiahtampil($hariini[0]->totals).'</h5>
                                        </div>
                                    </div>';
                                    $output .= '<div class="col-lg-12 col-12">';
                                    $output .= '<div class="overflow-auto" style="overflow-x:auto;">
                                                                <table id="example1" class="table table-bordered table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>No Transaksi</th>
                                                                            <th>Tanggal</th>
                                                                            <th>Nama Konsumen</th>
                                                                            <th>Nama Sales</th>
                                                                            <th>Total</th>
                                                                            <th>Terbayar</th>
                                                                            <th>Subtotal</th>
                                                                        </tr>
                                                                    </thead>';
                                                                    $n=1;
                                                    foreach($semua as $datatrans){
                                                        $output.="<tr>
                                                                    <td>".$n++."</td>
                                                                    <td>$datatrans->no_penjualan</td>
                                                                    <td>".date('d-M-Y', strtotime($datatrans->tgl_penjualan))."</td>
                                                                    <td>$datatrans->nama_konsumen</td>
                                                                    <td>$datatrans->namas</td>
                                                                    <td>".rupiahtampil($datatrans->total)."</td>
                                                                    <td>".rupiahtampil($datatrans->uang_dibayar)."</td>
                                                                    <td>".rupiahtampil($datatrans->totals)."</td>
                                                        </tr>";
                                                    }
                                                                    $output .= '</table>
                                    </div>';
            $output .= '</div>';
        echo $output;
    }

    function LaporanPiutang(){
        $menuku = "Laporan";
        $namasub="Laporan Piutang";
        $datakonsumen=Konsumen::where('no_konsumen','regexp','WHS|C')->get();
        $segmen=DB::select("SELECT DISTINCT segmentasi FROM tb_konsumen WHERE segmentasi IS NOT NULL");
        return view('Laporan.Lappiutang', compact('menuku','namasub'))
            ->with('konsumen',$datakonsumen)
            ->with('segmen',$segmen);

        
    }

    function Getlaporanpiutang(Request $request){
        $cust=$request->cust;
        $tgl1=$request->tgl1;
        $tgl2=$request->tgl2;
        $segmen=$request->segmen;
        $jam1='00:00:01';
        $jam2='23:59:59';

        if($cust=='-'){
            $semua = DB::select("SELECT kode_penjualan,no_penjualan,tgl_penjualan,IFNULL(nama_sales,'Tidak ada')namas,pajak,pph,diskon,nama_konsumen,total,SUM(total-diskon+pajak+pph)totals,uang_dibayar,SUM(total-diskon+pajak+pph-uang_dibayar)sisa FROM tb_penjualan a
            LEFT OUTER JOIN tb_konsumen b ON a.`kode_konsumen`=b.`kode_konsumen` 
            LEFT OUTER JOIN tb_sales c ON a.`kode_sales`=c.`kode_sales`
            where a.tgl_penjualan between '$tgl1 $jam1' and '$tgl2 $jam2' AND status_trs=2 and b.segmentasi regexp '$segmen'
            GROUP BY a.`kode_penjualan`");
        }else{
            
            $semua = DB::select("SELECT kode_penjualan,no_penjualan,tgl_penjualan,IFNULL(nama_sales,'Tidak ada')namas,pajak,pph,diskon,nama_konsumen,total,SUM(total-diskon+pajak+pph)totals,uang_dibayar,SUM(total-diskon+pajak+pph-uang_dibayar)sisa FROM tb_penjualan a
            LEFT OUTER JOIN tb_konsumen b ON a.`kode_konsumen`=b.`kode_konsumen` 
            LEFT OUTER JOIN tb_sales c ON a.`kode_sales`=c.`kode_sales`
            WHERE a.`kode_konsumen`='$cust' and b.segmentasi regexp '$segmen' and a.tgl_penjualan between '$tgl1 $jam1' and '$tgl2 $jam2' AND status_trs=2
            GROUP BY a.`kode_penjualan`");
        }

        $output = '';
        $con=0;
                                    $output .= '<div class="col-lg-12 col-12">';
                                    $output .= '<div class="overflow-auto" style="overflow-x:auto;">
                                                                <table id="example2" class="table table-bordered table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>No Transaksi</th>
                                                                            <th>Tanggal</th>
                                                                            <th>Nama Konsumen</th>
                                                                            <th>Nama Sales</th>
                                                                            <th>Total</th>
                                                                            <th>Terbayar</th>
                                                                            <th>Kekurangan</th>
                                                                        </tr>
                                                                    </thead>';
                                                    foreach($semua as $datatrans){
                                                        $output.="<tr>
                                                                    <td>#</td>
                                                                    <td>$datatrans->no_penjualan</td>
                                                                    <td>".date('d-M-Y', strtotime($datatrans->tgl_penjualan))."</td>
                                                                    <td>$datatrans->nama_konsumen</td>
                                                                    <td>$datatrans->namas</td>
                                                                    <td class='text-right'>".rupiahtampil($datatrans->total)."</td>
                                                                    <td class='text-right'>".rupiahtampil($datatrans->uang_dibayar)."</td>
                                                                    <td class='text-right'>".rupiahtampil($datatrans->total-$datatrans->uang_dibayar)."</td>
                                                        </tr>";
                                                        $con+=$datatrans->total-$datatrans->uang_dibayar;
                                                    }
                                                    $output.='<tr>
                                                    <th class="text-center" colspan="7">Total Piutang</th>
                                                    <th class="text-right">'.rupiahtampil($con).'</th>
                                                    </tr>';
                                                                    $output .= '</table>
                                    </div>';
            $output .= '</div>';
        echo $output;
    }

    function LaporanKas(){
        $menuku = "Laporan";
        $namasub="Laporan Kas";
        // $getbuton=getaccesbutton(4);
        $bank=DB::table('tb_bank')->get();
        return view('Laporan.LapKas', compact('menuku','namasub'))
            ->with('bank',$bank);
    }

    function Getkas(Request $request){
        $iduser= $request->kasir;
        $tgl1=$request->tgl1;
        $tgl2=$request->tgl2;
        $jam1='00:00:01';
        $jam2='23:59:59';

        if($iduser=='-'){
            $semua = DB::select("SELECT a.*,nama_konsumen,SUM(bayar_rp)jumlahtotal FROM tb_keuangan a
            LEFT OUTER JOIN tb_konsumen b ON a.`kode_customer`=b.`kode_konsumen`
            JOIN tb_d_pembayaran c ON a.`kode_dokumen`=c.`kode_dokumen`
            WHERE tgl_dokumen BETWEEN '$tgl1 $jam1' AND '$tgl2 $jam2'
            GROUP BY a.`kode_dokumen`");
        }else{
            $semua = DB::select("SELECT a.*,nama_konsumen,SUM(bayar_rp)jumlahtotal FROM tb_keuangan a
            LEFT OUTER JOIN tb_konsumen b ON a.`kode_customer`=b.`kode_konsumen`
            JOIN tb_d_pembayaran c ON a.`kode_dokumen`=c.`kode_dokumen`
            WHERE tgl_dokumen BETWEEN '$tgl1 $jam1' AND '$tgl2 $jam2'
            GROUP BY a.`kode_dokumen`");
        }

        $output = '';
        $con=0;
                                                    foreach($semua as $datatrans){
                                                        $output.="<tr>
                                                                    <td>#</td>
                                                                    <td>$datatrans->no_dokumen</td>
                                                                    <td>$datatrans->tgl_dokumen</td>
                                                                    <td>".date('d-M-Y', strtotime($datatrans->tgl_cair))."</td>
                                                                    <td>$datatrans->no_reff</td>
                                                                    <td>$datatrans->cara_bayar</td>
                                                                    <td>$datatrans->nama_konsumen</td>
                                                                    <td class='text-right'>".rupiahtampil($datatrans->jumlahtotal)."</td>
                                                        </tr>";
                                                        $con+=$datatrans->jumlahtotal;
                                                    }
                                                    // $output.='<tr>
                                                    // <th class="text-center" colspan="7">Total Penerimaan</th>
                                                    // <th class="text-right">'.rupiahtampil($con).'</th>
                                                    // </tr>';
    
        return $output;

    }

    function Cetakhariini($dates,$dates2){
        $data['hariini'] = DB::select("SELECT SUM(total+pajak+pph-diskon)total FROM tb_penjualan WHERE tgl_penjualan between '$dates 00:00:00' and '$dates2 23:59:59'");
        $data['detail'] = Keuangan::with('customer')
        ->whereBetween('tgl_cair', [$dates.' 00:00:00', $dates2.' 23:59:59'])
        ->where('status_dok','Selesai')
        ->get();

        $data['penjualan'] = DB::select("CALL omsetsamping('$dates','$dates2');");
        
        $data['awal']=$dates;
        $data['akir']=$dates2;

        $headers = [
            'Content-Type' => 'application/pdf'
        ];

        $pdf = PDF::loadView('Laporan.CetakLap',$data);
        $pdf->setPaper('A5', 'landscape');
        return $pdf->stream();
        // dd($data);

    }
}
