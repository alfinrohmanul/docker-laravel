<?php
 
namespace App\Exports;
 
use App\Models\Penjualan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;

class PiutangExport implements FromView,WithTitle
{
 
    public function __construct(string $keyword,$akir,$seg)
    {
        $this->tglawal = $keyword;
        $this->tglakir = $akir;
        $this->segment = $seg;
    }
    public function view(): View
    {
        $customers = Penjualan::with('customer')
                ->whereBetween('tgl_penjualan', [$this->tglawal.' 00:00:00', $this->tglakir.' 23:59:59'])
                ->where('status_trs',2)
                ->where('total','<>',0)
                ->whereRelation('customer','segmentasi','regexp',$this->segment)
                ->get();

        return view('Template.exportpiutang', [
            'data' => $customers
        ]);
    }
    public function title(): string
    {
        return 'Laporan Piutang';
    }
    

}