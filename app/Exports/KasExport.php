<?php

namespace App\Exports;

use App\Models\Penjualan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;

class KasExport implements FromView,WithTitle
{
    public function __construct(string $keyword,$akir)
    {
        $this->tglawal = $keyword;
        $this->tglakir = $akir;
    }
    public function view(): View
    {

        return view('Template.exportkas', [
            'data' => DB::select("SELECT a.*,nama_konsumen,SUM(bayar_rp)jumlahtotal FROM tb_keuangan a
            LEFT OUTER JOIN tb_konsumen b ON a.`kode_customer`=b.`kode_konsumen`
            JOIN tb_d_pembayaran c ON a.`kode_dokumen`=c.`kode_dokumen`
            WHERE tgl_dokumen BETWEEN '$this->tglawal 00:00:01' AND '$this->tglakir 23:59:59'
            GROUP BY a.`kode_dokumen`")
        ]);
    }
    public function title(): string
    {
        return 'Laporan Kas';
    }
}
