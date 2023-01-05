<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use DataTables;
use App\Models\Pembayaran;
use App\Models\Penjualan;
use App\Models\Jurnal;
use App\Models\Keuangan;
use App\Models\Akun;
use App\Models\Konsumen;
use App\Models\ActivityLog;

class PelunasanController extends Controller
{
    public function __construct()
    {
        if (Auth::check()) {
            return redirect('Home');
        }else{
            return view('welcome');
        }
    }

    function PelunasanPiutang(){
        $menuku = "Finance Accounting";
        $namasub="Pelunasan Piutang";
        $getbuton=getaccesbutton(23);
        $date=date('Y-m-d');
        $hariini=Keuangan::with('customer')
                    ->whereBetween('tgl_dokumen', [$date.' 00:00:00', $date.' 23:59:59'])
                    ->get();
        $konsumen=Konsumen::all();           

        return view('Pelunasan.Index', compact('menuku','namasub'))
                ->with('butons',$getbuton)
                ->with('konsumen',$konsumen)
                ->with('hariini',$hariini);
    }

    function GetLunas(Request $request){
        $kode=$request->konsumen;
        $segm=$request->segm;
        $tgl1=$request->tgl1;
        $tgl2=$request->tgl2;

        $semua=Keuangan::with('customer')
        ->whereBetween('tgl_dokumen', ['2022-05-01 00:00:00', $tgl2.' 23:59:59'])
        ->whereRelation('customer','segmentasi','regexp',$segm)
        ->get();
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
                                                                    <td>".$datatrans->customer->nama_konsumen."</td>
                                                                    <td class='text-right'>".rupiahtampil($datatrans->jumlah_rp)."</td>
                                                                    <td class='text-center'><span class='badge bg-success'>$datatrans->status_dok</span></td>
                                                                    <td class='text-right'>#</td>
                                                        </tr>";
                                                    }
                                                    return $output;
    }

    function TablePembayaran(){
        $data = DB::select("SELECT a.*,nama_konsumen,SUM(bayar_rp)jumlahtotal FROM tb_keuangan a
        LEFT OUTER JOIN tb_konsumen b ON a.`kode_customer`=b.`kode_konsumen`
        JOIN tb_d_pembayaran c ON a.`kode_dokumen`=c.`kode_dokumen`
        GROUP BY a.`kode_dokumen`");
        
        return Datatables::of($data)
            ->addColumn('jumlahtotal', function ($data) {
                $update = "<td style='text-align:right'>".rupiahtampil($data->jumlahtotal)."</td>";
                return $update;
            })
            ->addColumn('tgl_cair', function ($data) {
                $update = date('d-M-Y', strtotime($data->tgl_cair));
                return $update;
            })
            ->rawColumns(['jumlahtotal'],['tgl_dokumen'])
            ->make(true);
    }

    function CreatePelunasan(){
        $menuku = "Finance Accounting";
        $namasub="Pelunasan Piutang";
        $getbuton=getaccesbutton(23);
        $akun=Akun::all();
        $konsumen=Konsumen::all();
        
        $countermu=DB::select("SELECT IFNULL(MAX(urut)+1,1) nomer FROM tb_keuangan WHERE DATE(created_at)=DATE(NOW())");
        $urut=$countermu[0]->nomer;
        $tgltrans = date('Y-m-d');
        $kodes=get_kos($urut);
        $kode_u=get_fj('0723',$kodes,$urut,$tgltrans);

        return view('Pelunasan.Tester', compact('menuku','namasub','kode_u'))
                ->with('konsumen',$konsumen)
                ->with('akun',$akun);
    }

    function Transaksi($id){
        $data = DB::select("SELECT kode_penjualan,no_penjualan,tgl_penjualan,nama_konsumen,SUM(total-diskon+pajak+pph)totals,uang_dibayar FROM tb_penjualan a
        LEFT OUTER JOIN tb_konsumen b ON a.`kode_konsumen`=b.`kode_konsumen`
        WHERE kode_penjualan='$id'");

        $output="";
        $output .= '<td style="width: 30%;"><input class="form-control form-control-sm" type="text" name="namsupp" value="'.$data[0]->nama_konsumen.'" hidden>' . $data[0]->nama_konsumen . '</td>';
        $output .= '<td style="width: 20%;"><input class="form-control form-control-sm" type="text" name="kodejual" value="'.$data[0]->kode_penjualan.'" hidden>' . $data[0]->tgl_penjualan . '</td>';
        $output .= '<td style="width: 10%;"><select class="form-control form-control-sm" name="pembayarans">
        <option value="Cash">Cash</option>
        <option value="Transfer">Transfer</option>
                                                                   </select></td>';
        $output .= '<td style="width: 10%;text-align: right">' . rupiahtampil($data[0]->totals) . '</td>';
        $output .= '<td style="width: 20%;text-align: right">' . rupiahtampil($data[0]->uang_dibayar) . '</td>';
        $output .= '<td style="width: 20%;text-align: right"><input class="form-control form-control-sm text-right" onkeyup="nanas()" type="text" name="bayaran" id="bayaran" autocomplete="off"></td>';
        $output .= "<script>$('#bayaran').priceFormat({
            prefix: '',
            centsLimit: 0,
            thousandsSeparator: '.',
        });</script>";
        echo $output;
    }


    function PelunasanU($id, Request $request){

        $getpenjualan=Penjualan::where('kode_konsumen',$id)
                                ->where('status_trs','<>',3);

        $output="";
        $n=1;
        $urutan = 0;
        
        if($getpenjualan->count()>0){
            foreach($getpenjualan->get() as $pj){
            $output .= '<tr id="row' . $urutan++ . '" class="recod" ><td style="width: 5%;">'.$n++.'</td>';
            $output .= '<td style="width: 20%;" contentEditable="false" data-id="" hidden>'.$pj->kode_penjualan.'</td>';
            $output .= '<td style="width: 20%;">'.$pj->no_penjualan.'</td>';
            $output .= '<td style="width: 20%;">'.date('d-M-Y', strtotime($pj->tgl_penjualan)).'</td>';
            $output .= '<td style="width: 10%;" class="text-right">'.rupiahtampil($pj->total).'</td>';
            $output .= '<td style="width: 10%;" class="text-right">'.rupiahtampil($pj->total - $pj->uang_dibayar).'</td>';
            // $output .= '<td hidden style="width: 15%;text-align: right"  id="bayard"></td>';
				$output .= '<td style="width: 5%;">
									<input class="messageCheckbox" type="checkbox" id="vehicle1" name="vehicle1[]">
							</td>';
            $output .= '<td style="width: 20%;" ><input class="form-control form-control-sm text-right" type="text" name="bayaran" autocomplete="off"></td></tr>';
    
        } 
        }else{
            $output.='<tr><td colspan="6" class="text-center font-italic">Tidak ada piutang</td></tr>';
        }
       
        
        return $output;
    }

    function  Tester(Request $request){
        $data = array();
        $bb=0;
        $id_user=Auth::user()->id;
        $dtNow = date('Y-m-d H:i:s', time());
        $countermu=DB::select("SELECT IFNULL(MAX(urut)+1,1) nomer FROM tb_keuangan WHERE DATE(created_at)=DATE(NOW())");
        $urut=$countermu[0]->nomer;
        $tgltrans = date('Y-m-d');
        $kodes=get_kos($urut);
        $kode_u=get_fj('0723',$kodes,$urut,$tgltrans);
        //Simpan Master Keuangan
        $sp=generatecode('KU');

        Keuangan::create(array(
            'kode_dokumen'      => $sp,
            'no_dokumen'        => $kode_u,
            'tgl_dokumen'       => $dtNow,
            'no_reff'           => '-',
            'tgl_cair'          => $request->tanggal,
            'kode_customer'     => $request->konusmen,
            'kode_akun_debet'   => 'AKN0000000069',
            'cara_bayar'        => $request->pembayaran,
            'catatan'           => 'Pembayaran Piutang',
            'kepada'            => '-',
            'jumlah_rp'         => 0,
            'status_dok'        => 'Selesai',
            'userid'            => $id_user,
            'urut'              => $urut
        ));

        //Batas Master Keuangan
		for($a=0;$a<count($request->id);$a++){

			$colm=explode('z',$request->id[$a]);
			$rega=str_replace(".","",$colm[1]);
			// array_push($data,array(
			
			// ));
		
            Pembayaran::create(array(
                "kode_dokumen"      => $sp,
	            "id_dokumen"        => $a,
				"kode_doktransaksi" => $colm[0],
				"bayar_rp"          => str_replace(".","",$colm[1])
            ));

			$bb+=$rega;
            // var_dump($data);

            $sum = Pembayaran::where('kode_doktransaksi', $colm[0])->sum('bayar_rp');

        DB::table('tb_penjualan')->where('kode_penjualan',$colm[0])->update([
            'uang_dibayar'   => $sum
        ]);

        DB::update("UPDATE tb_penjualan SET status_trs='3' WHERE kode_penjualan='$colm[0]' AND uang_dibayar>=(total-diskon+pajak+pph)");
		}

        ActivityLog::create(array(
            'log_name'      => 'Pelunasan',
            'keterangan'    => 'Membuat Pelunasan '. $request->nopelunasan,
            'id_user'       => Auth::user()->id
        )); 

        return $data;
    }
}
