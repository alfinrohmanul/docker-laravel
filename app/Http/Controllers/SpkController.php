<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Konsumen;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Detailpenjualan;
use App\Models\User;
use DataTables;
use PDF;

class SpkController extends Controller
{
    public function __construct()
    {
        if (Auth::check()) {
            return redirect('Home');
        }else{
            return view('welcome');
        }
    }

    function Printspk($key,$id){
        $data['master']=Penjualan::find($key);
        $data['cust']=Konsumen::find($data['master']['kode_konsumen']);
        $data['pencatat']=User::find($data['master']['id_user']);
        $data['detail'] = DB::select("SELECT tb_d_penjualan.*,nama_barang,is_ukuran 
        FROM tb_d_penjualan 
        INNER JOIN tb_barang ON tb_d_penjualan.id_barang = tb_barang.kode_barang WHERE (tb_d_penjualan.`id`='$id')");

        return view('espk.Print',$data);
        // $headers = [
        //     'Content-Type' => 'application/pdf'
        // ];
        // $customPaper = array(0,0,800,800);
        // $pdf = PDF::loadView('espk.Print', $data);
        // $pdf->setPaper('A4', 'potrait');
        // return $pdf->stream();

    }

    function GetSpk($kode_transaksi){

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
                                                <input type="text font-weight-bold" class="form-control form-control-sm" name="namas" value="' . $masterkonsumen->nama_konsumen . '" placeholder="0" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="nama">Nomor HP</label>
                                                <input type="text font-weight-bold" class="form-control form-control-sm" name="telf" value="' . $masterkonsumen->no_hp . '" placeholder="0" disabled>
                                            </div>
                                        </div>
                                    </div>';
		$output .= '<div class="row">
                                <div class="col-lg-12">
                                    <div class="overflow-auto" style="overflow-x:auto;">
								
                                    <table id="example1" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th style="width: 20%;">Layanan</th>
                                                <th style="width: 20%;">File</th>
                                                <th style="width: 5%;">Cetak(pcs)</th>
                                                <th style="width: 5%;">Cetak SPK</th>
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
                                            <td class="text-center"> ' . $dtr->jumlah . '</td>
                                            <td><a href="' . url("CetakSpk") .'/' . $masertransaski->kode_penjualan . '/'.$dtr->id.'" type="button" target="_blank" class="btn btn-warning btn-xs "><i class="fas fa-print"></i></a></td>
                                        </tr>';
		}
		$output .= '        </table></div>
                                </div>';

        $output .= ' <div class="col-lg-12">
	
                                <a href="' . url("Penjualan/printNotaKecil/") .'/' . $masertransaski->kode_penjualan . '" type="button" target="_blank" class="ml-3 btn btn-success btn-sm float-right"><i class="fas fa-file"></i> Invoice</a>
                                <a href="' . url("Penjualan/printNotaBesar/") .'/' . $masertransaski->kode_penjualan . '" type="button" target="_blank" class="ml-3 btn btn-success btn-sm float-right"><i class="fas fa-file"></i> Surat Jalan</a>
                        </div>';
		$output .= '</div>';

		return $output;
    }
}
