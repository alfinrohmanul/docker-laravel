<html>

<head>
    <title>Nota Penjualan</title>
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

        <table style='width:700px; font-size:12pt; font-family:calibri; border-collapse: collapse;' border='0'>

            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                <!-- <img src="assets/kop_insan.png" alt="" height=100 width=300></img> -->
                <span style='font-size:20pt'><b>CV. WAHANA SATRIA</I></b></span>
<br>
                Jl. Prof. M Yamin III, Karangpucung, Purwokerto Selatan </br>
            </td>
          
        </table>
        <center><h2><u>SURAT JALAN</u></h2></center>
        <table style='width:700px; font-size:12pt; font-family:calibri; border-collapse: collapse;' border='0'>

        <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
            Nama Konsumen : {{$cust->nama_konsumen}}</br>
            <br>
            Harap diterima barang-barang tersebut dibawah ini dengan baik</br>
     
            
        </td> 

        </table>

        <table cellspacing='0' style='width:700px; font-size:10pt; font-family:calibri;  border-collapse: collapse; margin-top:10pt' border='1'>

            <tr align='center'>
                <td>NO</td>
                <td width='60%'>NAMA BARANG</td>
                <td width='10%'>JUMLAH</td>
                <td width='30%'>KETERANGAN</td>
            </tr>
            <?php
            $n=1;
            ?>
            @foreach($detail as $dt)
                <tr>
                    <td><?=$n++?></td>
                    <td style='text-align:left'>{{$dt->nama_file}} / {{$dt->nama_barang}} </td>
                    <td style='text-align:center'>{{$dt->jumlah}}</td>
                    <td></td>
                </tr>
            @endforeach
            <?php ?>
        </table>


        <table cellspacing='0' style='width:700px; font-size:10pt; font-family:calibri;  border-collapse: collapse; margin-top:5pt;' border='0'>
 
        <tr>
                <td width='25%'>Brang-barang tersebut di atas telah kami terima dengan baik dan cukup, terima kasih</td>

            </tr>

        </table>
        <table cellspacing='0' style='width:700px; font-size:Helvetica; font-family:Helvetica;  border-collapse: collapse; margin-top:5pt;' border='0'>
<tr>
    <td width='80%' style='text-align:right'>Purwokerto, <?=date('d-M-Y')?></td>
    <td></td>
</tr>
</table>
        <table cellspacing='0' style='width:700px; font-size:Helvetica; font-family:Helvetica;  border-collapse: collapse; margin-top:5pt;' border='0'>

        <tr>
            <th width='25%' style='text-align:center'>Yang menerima</th>
            <th width='25%' style='text-align:center'>Hormat kami,</th>
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

</html>