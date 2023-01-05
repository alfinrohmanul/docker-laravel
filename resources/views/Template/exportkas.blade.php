<table border="1">
    <thead>
        <tr>
            <th colspan="7" style="text-align:center;">Laporan Kas Masuk</th>
        </tr>
        <tr>
            <th>No Dokumen</th>
            <th>Tanggal</th>
            <th>Tanggal Pembayaran</th>
            <th>No Reff</th>
            <th>Via</th>
            <th>Nama Konsumen</th>
            <th>Terbayar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
            <tr>
                <td>{{$dt->no_dokumen}}</td>
                <td>{{$dt->tgl_dokumen}}</td>
                <td>{{date('Y-m-d', strtotime($dt->tgl_cair))}}</td>
                <td>{{$dt->no_reff}}</td>
                <td>{{$dt->cara_bayar}}</td>
                <td>{{$dt->nama_konsumen}}</td>
                <td>{{$dt->jumlahtotal}}</td>
            </tr>
        @endforeach
    </tbody>
</table>