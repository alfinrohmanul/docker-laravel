<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SPK</title>

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->

    <link href="{{url('assets/spk/all.min.css')}}" rel="stylesheet">

<!-- Styles -->
<link href="{{url('assets/spk/bootstrap.min.css')}}" rel="stylesheet">

    <style>
        table tr th {
            font-size: 10px;
        }
        table tr td {
            font-size: 12px;
        }
        @page { size: 10cm 33cm potrait; }

    </style>
</head>
<body>
    <div id="app">
        <main class="py-1">
            <div class="container-fluid">
            @foreach($detail as $generatespk)
                <div class="row">
                  <div class="col-12">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 border border-3">
                        <h1 class="text-center fw-bold text-uppercase my-2">spk</h1>
                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center">pemesan</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center">{{$cust->nama_konsumen}}</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center">judul</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center">{{$generatespk->nama_file}}</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">no nota</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">tgl spk dibuat</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">tgl SPK disetujui/tgl order</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">rencana jadi</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{substr($master->no_penjualan,7)}}</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{$master->tgl_penjualan}}</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">-</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">.</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">jenis order</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">jumlah</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">ukuran</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">warna tinta</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{$generatespk->nama_barang}}</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{$generatespk->jumlah}}</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">.</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">.</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">cetak</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">finishing</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                            <td>
                               <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" checked="">
                                            <label class="form-check-label">OFFSET</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" >
                                            <label class="form-check-label">________</label>
                                        </div>
                                    </div>  
                            </td>
                            <td>
                               <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">Porporasi </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" >
                                            <label class="form-check-label">________</label>
                                        </div>
                                    </div>  
                            </td>
                            </tr>

                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">jenis kertas</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">penerima order</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">pencatat</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;"></td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">
                                  {{$pencatat->name}}
                                </td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">
                                {{Auth::user()->name}}
                                </td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">desain</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">cetak</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">finishing</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">.</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">Wahana</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">Wahana</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase">keterangan:</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase"> <textarea class="form-control" rows="2" placeholder="Keterangan ..."></textarea></td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col">
                                <div class="d-flex justify-content-end"><img src="{{ url('assets/dist/img/acc2.png') }}" class="p-2 mb-2" style="max-width: 60px; border: 1px solid #202020"></div>
                            </div>
                        </div>
                    </div>
                    
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    </div>

   

    <script>
        // window.print();
    </script>
</body>
</html>
