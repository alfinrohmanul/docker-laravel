<html>

<head>
    <title>Pemasukan {{$awal}} s/d{{$akir}}</title>
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

<body style='font-family:tahoma; font-size:12pt; margin-top:20pt'>

        <table style='width:700px; font-size:12pt; font-family:calibri; border-collapse: collapse;' border='0'>

            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                <!-- <img src="assets/kop_insan.png" alt="" height=100 width=300></img> -->
                <span style='font-size:20pt'><b>CV. WAHANA SATRIA</I></b></span>
<br>
                Jl. Prof. M Yamin III, Karangpucung, Purwokerto Selatan </br>
            </td>
          
        </table>
        <center><h4>Laporan Pemasukan Kasir</h4></center>
        Tanggal : {{date('d-M-Y', strtotime($awal))}} s/d {{date('d-M-Y', strtotime($akir))}}
        <table cellspacing='0' style='width:700px; font-size:12pt; font-family:calibri;  border-collapse: collapse; margin-top:10pt' border='1'>
        
            <tr align='center'>
                <td width='5%'>No</td>
                <td width='40%'>Keterangan Akun</td>
                <td width='15%'>Cash</td>
                <td width='15%'>Transfer</td>
            </tr>
            <?php
            $n=1;
            ?>
             <tr>
                    <td style='text-align:center'>1</td>
                    <td style='text-align:left'>Omset</td>
                    <td colspan='2' style='text-align:center'>{{rupiahtampil($hariini[0]->total)}}</td>
                </tr>
             <tr>
                    <td style='text-align:center'>2</td>
                    <td style='text-align:left'>Penerimaan Penjualan</td>
                    <td style='text-align:right'>{{rupiahtampil($penjualan[0]->Tunai)}}</td>
                    <td style='text-align:right'>{{rupiahtampil($penjualan[0]->Transfer)}}</td>
                </tr>
             <tr>
                    <td style='text-align:center'>3</td>
                    <td style='text-align:left'>Penerimaan Piutang</td>
                    <td style='text-align:right'>{{rupiahtampil($penjualan[1]->Tunai)}}</td>
                    <td style='text-align:right'>{{rupiahtampil($penjualan[1]->Transfer)}}</td>
                </tr>
             <tr>
                    <td style='text-align:center'>4</td>
                    <td style='text-align:left'>Piutang Hari Ini</td>
                    <td colspan='2' style='text-align:center'>{{rupiahtampil($penjualan[2]->Transfer)}}</td>
                </tr>
            <?php ?>
            <tr>
                <td colspan='2' style='text-align:center'>Total</td>
                <td style='text-align:right'></td>
                <td style='text-align:right'>-</td>
            </tr>
        </table>


        <table cellspacing='0' style='width:700px; font-size:Helvetica; font-family:Helvetica;  border-collapse: collapse; margin-top:5pt;' border='0'>

        <tr>
            <th width='25%' style='text-align:center'>Penerima</th>
            <th width='25%' style='text-align:center'>Penyetor</th>
        </tr>
        </table>
<br>
<br>
        <table cellspacing='0' style='width:700px; font-size:Helvetica; font-family:Helvetica;  border-collapse: collapse; margin-top:5pt;' border='0'>

        <tr>
            <td width='25%' style='text-align:center'>(........................)</td>
            <td width='25%' style='text-align:center'>(........................)</td>
        </tr>
        </table>
        
    <script>
        // window.addEventListener("load", window.print());
    </script>
</body>
<body>
<center><h4>Laporan Detail</h4></center>
<table cellspacing='0' style='width:700px; font-size:12pt; font-family:calibri;  border-collapse: collapse; margin-top:10pt' border='1'>
            <tr align='center'>
                <th width='20%'>No Pembayaran</th>
                <th width='35%'>Konsumen</th>
                <th width='20%'>Tanggal Bayar</th>
                <th width='10%'>Via</th>
                <th width='15%'>Total</th>
            </tr>
            @foreach($detail as $pj)
            <tr>
                <td>{{$pj->no_dokumen}}</td>
                <td>{{$pj->customer->nama_konsumen}}</td>
                <td>{{date('d-M-Y', strtotime($pj->tgl_cair))}}</td>
                <td>{{$pj->cara_bayar}}</td>
                <td style='text-align:right'>{{rupiahtampil($pj->jumlah_rp)}}</td>
            </tr>
            @endforeach
        </table>
</body>
</html>