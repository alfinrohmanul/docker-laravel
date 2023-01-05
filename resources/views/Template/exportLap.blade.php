<table border="1">
    <thead>
        <tr>
            <th>NO PENJUALAN</th>
            <th>TANGGAL</th>
            <th>TOTAL</th>
            <th>DISKON</th>
            <th>PPN</th>
            <th>PPH</th>
            <th>TERBAYAR</th>
            <th>KODE KONSUMEN</th>
            <th>NAMA KONSUMEN</th>
            <th>NAMA SALES</th>
            <th>SEGMENTASI</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
            <tr>
                <td>{{$dt->no_penjualan}}</td>
                <td>{{date('Y-m-d', strtotime($dt->tgl_penjualan))}}</td>
                <td>{{$dt->total}}</td>
                <td>{{$dt->diskon}}</td>
                <td>{{$dt->pajak}}</td>
                <td>{{$dt->pph}}</td>
                <td>{{$dt->uang_dibayar}}</td>
                <td>{{$dt->no_konsumen}}</td>
                <td>{{$dt->nama_konsumen}}</td>
                <td>{{$dt->nama_sales}}</td>
                <td>{{$dt->segmentasi}}</td>
            </tr>
        @endforeach
    </tbody>
</table>