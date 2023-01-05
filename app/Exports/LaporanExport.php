<?php
 
namespace App\Exports;
 
use App\Models\Penjualan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;

class LaporanExport implements FromView,WithTitle
{
 
    public function __construct(string $keyword,$akir,$seg)
    {
        $this->tglawal = $keyword;
        $this->tglakir = $akir;
        $this->segmen = $seg;
    }
    public function view(): View
    {
        return view('Template.exportLap', [
            'data' => DB::select("SELECT a.*,no_konsumen,nama_konsumen,segmentasi,nama_sales FROM tb_penjualan a
            LEFT OUTER JOIN tb_konsumen b ON a.`kode_konsumen`=b.`kode_konsumen`
            LEFT OUTER JOIN tb_sales c ON a.`kode_sales`=c.`kode_sales`
            WHERE a.`tgl_penjualan` BETWEEN '$this->tglawal 00:00:00' AND '$this->tglakir 23:59:59' and b.segmentasi regexp '$this->segmen'")
        ]);
    }
    public function title(): string
    {
        return 'Laporan Singkat';
    }

}