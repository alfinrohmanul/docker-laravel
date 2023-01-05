<table>
    <thead>
        <tr>
            <th>NO PENJUALAN</th>
            <th>TANGGAL</th>
            <th>NAMA KONSUMEN</th>
            <th>NAMA BARANG</th>
            <th>JUMLAH</th>
            <th>HARGA</th>
            <th>TOTAL</th>
        </tr>
    </thead>

    <tbody>

    @foreach($data as $key)
        <tr>
        <td>{{$key->no_penjualan}}</td>
        <td>{{$key->tgltr}}</td>
        <td>{{$key->nama_konsumen}}</td>
        <td>{{$key->nama_barang}}</td> 
        <td>{{$key->jumlah}}</td>
        <td>{{$key->harga}}</td> 
        <td>{{$key->subtotal}}</td> 
        </tr>
    @endforeach
    </tbody>
</table>