@php
    $jum = 1;
    @endphp
    @foreach($data as $key)
    @if($jum <= 1)
        
        <tr>
        <td rowspan="{{$key->tesr}}">{{$key->no_penjualan}}</td>
        <td rowspan="{{$key->tesr}}">{{$key->tgltr}}</td>
        <td rowspan="{{$key->tesr}}">{{$key->nama_konsumen}}</td>
        @php      
        $jum = $key->tesr;       
        @endphp                   
        @else
        @php
            $jum = $jum - 1;
        @endphp
    @endif
    <td>{{$key->nama_barang}}</td> 
    <td>{{$key->jumlah}}</td>
    <td>{{$key->harga}}</td> 
    <td>{{$key->subtotal}}</td> 
    </tr>
            @endforeach