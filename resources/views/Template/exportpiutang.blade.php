<table border="1">
    <thead>
        <tr>
            <th colspan="7" style="text-align:center;">Laporan Piutang</th>
        </tr>
        <tr>
            <th>KODE KONSUMEN</th>
            <th>NAMA KONSUMEN</th>
            <th>SEGMENTASI</th>
            <th>NO PENJUALAN</th>
            <th>TANGGAL</th>
            <th>PIUTANG</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
            <tr>
                <td>{{$dt->customer->no_konsumen}}</td>
                <td>{{$dt->customer->nama_konsumen}}</td>
                <td>{{$dt->customer->segmentasi}}</td>
                <td>{{$dt->no_penjualan}}</td>
                <td>{{date('Y-m-d', strtotime($dt->tgl_penjualan))}}</td>
                <td>{{$dt->total-$dt->uang_dibayar}}</td>
            </tr>
        @endforeach
    </tbody>
</table>