<html>

<head>
    <title>Invoice</title>
    <style>
        #tabel {
            font-size: 20px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }

        @media print{
    @page {
        size: a5 landscape;
        margin: 0;
    }
}
    </style>
</head>

<body style='font-family:tahoma; font-size:10pt; margin-top:20pt'>

        <table style='width:700px; font-size:10pt; font-family:calibri; border-collapse: collapse;' border='0'>

            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
            <img src="{{ public_path('/assets/dist/img/kiss.png') }}" alt="logo" height=80 width=360></img>
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                <b><span style='font-size:20pt'>INVOICE</span></b><hr>
                <?=date('d-M-Y H:i:s')?>
            </td>
        </table>
        <table style='width:700px; font-size:10pt; font-family:calibri;  border-collapse: collapse; margin-top:10pt' border='0' >
        <tr>
             <td width='15%'>No Nota</td>
             <td width='1%'>:</td>
             <td width='50%'>{{$master->no_penjualan}}</td>
             <td width='15%'>Customer</td>
             <td width='1%'>:</td>
             <td width='50%'>{{$cust->nama_konsumen}}</td>
        </tr>
        <tr>
            <td width='15%'>Tgl Order</td>
            <td width='1%'>:</td>
            <td width='50%'>{{$master->tgl_penjualan}}</td>
            <td width='15%'>Alamat</td>
             <td width='1%'>:</td>
             <td width='50%'>{{$cust->alamat}}</td>
    </tr>
        </table>
        <table cellspacing='0' style='width:700px; font-size:10pt; font-family:calibri;  border-collapse: collapse; margin-top:10pt' border='1'>

            <tr align='center'>
                <td width='50%'>Nama Barang / Layanan</td>
                <td width='10%'>Ukuran</td>
                <td width='5%'>Quantity</td>
                <td width='12%'>Harga Satuan</td>
                <td width='12%'>Sub Total</td>
            </tr>
            @foreach($detail as $dt)

                <tr>
                    <td style='text-align:left'>{{$dt->nama_file}} / {{$dt->nama_barang}} </td>
                    @if($dt->is_ukuran=='Y')
                    <td style='text-align:center'>{{$dt->panjang}}*{{$dt->lebar}}</td>
                    @else
                    <td style='text-align:center'>-</td>
                    @endif

                    <td style='text-align:center'>{{$dt->jumlah}}</td>
                    <td style='text-align:right'>{{rupiahtampil($dt->harga)}}</td>
                    <td style='text-align:right'>{{rupiahtampil($dt->subtotal)}}</td>
                </tr>
            @endforeach
            <?php ?>
        </table>


        <table cellspacing='0' style='width:700px; font-size:10pt; font-family:calibri;  border-collapse: collapse; margin-top:5pt;' border='0'>

            <tr>
                <td width='25%'></td>
                <td width='25%'></td>
                <td width='10%'></td>
                <td width='5%'></td>
                <td width='12%'></td>
                <td width='12%'></td>
            </tr>

            <tr>
                <td  colspan='6' width='25%' style='text-align:left;font-size:12pt;'>*<i>Keterangan</i></td>
            </tr>
            <tr>
            <td colspan='6' width='25%' style='text-align:left;font-size:10pt;'>- {{$master->keterangan}}</td>
            </tr>

            @if($master->kode_pembayaran=='Transfer')
            <tr>
            <td  colspan='6' width='25%' style='text-align:left'>*<i>Pembayaran Melalui Bank</i></td>
            </tr>
            <tr>
                <?php
                    $getbank=DB::select("select * from tb_bank where id='".$master->bank."'");
                ?>
            <td colspan='6' width='25%' style='text-align:left'>-<?=$getbank[0]->nama_bank?> || <?=$getbank[0]->no_rekening?></td>
  </tr>
            @endif

            <tr>
                <td colspan='6'><hr></td>
            </tr>
            <tr>
                <td style='text-align:left'>Total :</td>
                <td style='text-align:left'>Rp {{rupiahtampil($master->total)}}</td>
                <td width='10%'></td>
                <td colspan='2'><div style='text-align:right'>GrandTotal : </div></td>
                <?php
                    $kekurangan=$master->total-$master->diskon+$master->pajak+$master->pph-$master->uang_dibayar;
                    $substotal=$master->total-$master->diskon+$master->pajak+$master->pph;
                ?>
                <td style='text-align:right' width='15%'>Rp <?=rupiahtampil($substotal)?></td>
            </tr>
            <tr>
                <td style='text-align:left'>Diskon/Potongan :</td>
                <td style='text-align:left'>Rp {{rupiahtampil($master->diskon)}}</td>
                <td width='10%'></td>
                <td colspan='2'><div style='text-align:right'>Bayar : </div></td>
                <td style='text-align:right' width='15%'>Rp {{rupiahtampil($master->uang_dibayar)}}</td>
            </tr>
            <tr>
                <td style='text-align:left'>PPn :</td>
                <td style='text-align:left;'>Rp {{rupiahtampil($master->pajak)}}</td>
                <td width='10%'></td>
                <td colspan='2'><div style='text-align:right'>Kekurangan : </div></td>
                <td style='text-align:right' width='15%'>Rp <?=rupiahtampil($kekurangan)?></td>
            </tr>
            <tr>
                <td style='text-align:left'>PPH :</td>
                <td style='text-align:left;'>Rp {{rupiahtampil($master->pph)}}</td>
                <td width='10%'></td>
                <td colspan='2'><div style='text-align:right'>Tempo : </div></td>
                <td style='text-align:right' width='15%'>{{$master->kode_pembayaran}}</td>
            </tr>
            <tr>
                <td width='25%'></td>
                <td width='25%'></td>
                <td width='10%'></td>
                <td colspan='2'><div style='text-align:right'>Cara Bayar : </div></td>
                <td style='text-align:right' width='15%'>{{$master->tipe_bayar}}</td>
            </tr>

        </table>

        <div class="footer" style="font-size: 10px; ">
                    Alamat : Jl. Moch. Yamin Gang III No.5, Karangpucung, Purwokerto Selatan
                </div>
    <script>
        // window.addEventListener("load", window.print());
    </script>
</body>

</html>
