<?php
 
namespace App\Exports;
 
use App\Models\Penjualan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;


class DetailExport implements FromView,WithTitle
{
 
    public function __construct(string $keyword,$kon,$gets)
    {
        $this->tglawal = $keyword;
        $this->tglakir = $kon;
        $this->segmen = $gets;

    }
    public function view(): View
    {
        return view('Template.exportdetail', [
            'data' => DB::select("SELECT no_penjualan,a.kode_konsumen,nama_konsumen,DATE_FORMAT(tgl_penjualan,'%d-%m-%Y')tgltr,nama_barang,jumlah,b.harga,subtotal,(SELECT COUNT(kode_penjualan) FROM tb_d_penjualan WHERE kode_penjualan=a.kode_penjualan)tesr FROM tb_penjualan a
            JOIN tb_d_penjualan b ON a.`kode_penjualan`=b.`kode_penjualan`
            JOIN tb_konsumen c ON a.`kode_konsumen`=c.`kode_konsumen`
            JOIN tb_barang d ON b.`id_barang`=d.`kode_barang`
            WHERE a.`tgl_penjualan` BETWEEN '$this->tglawal 00:00:00' AND '$this->tglakir 23:00:01' and c.segmentasi regexp '$this->segmen' ORDER BY DATE(tgl_penjualan) ASC")
        ]);
    }
    public function title(): string
    {
        return 'Laporan Detail';
    }    

}