@include('Head')
@include('Menu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">


            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{url('Penjualan/actionUbahPembayaran')}}/{{ Request::segment(3) }}" method="POST">
            {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <a href="#" class="btn btn-secondary mr-2 float-left"> <i class="fas fa-arrow-circle-left"></i> Kembali</a>
                        <!-- <a href="#" class="btn btn-danger mr-2 float-right konfirmasi-hapus"> <i class="fas fa-trash-alt"></i> Hapus Transaksi</a> -->

                    </div>
                    <div class="col-lg-12">
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Pelanggan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body py-2">
                                        <div class="row">
                                            <div class="col-lg-4 col-4">
                                                <div class="form-group">
                                                    <label class="col-form-label-sm" for="nama">Nama Pelanggan</label>
                                                    <input type="text font-weight-bold" class="form-control form-control-sm" id="" name="nama" value="{{$masterkonsumen->nama_konsumen}}" placeholder="0" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-4 ">
                                                <div class="form-group">
                                                    <label class="col-form-label-sm" for="nama">Nomor HP</label>
                                                    <input  type="text font-weight-bold" class="form-control form-control-sm" id="" name="nohp" value="{{$masterkonsumen->no_hp}}" placeholder="0" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-4">
                                                <div class="form-group">
                                                    <label class="col-form-label-sm" for="nama">Status Transaksi</label>
                                                    <input type="text font-weight-bold" class="form-control form-control-sm" id="" name="" value="{{$keter}}" placeholder="0" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-12">
                                                <div class="form-group">
                                                    <label>Keterangan (isi dengan nomer PO)</label>
                                                    <textarea class="form-control" rows="2" placeholder="Isi dengan Nomer PO" name="keterangan">{{$master->keterangan}}</textarea>
                                                </div>
                                            </div>
                                       
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="card card-primary card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                    <li class="pt-2 px-3"><h3 class="card-title">Detail Transaksi</h3></li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-detail" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Detail</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-pembayaran" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Pembayaran</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Jurnal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Settings</a>
                                    </li> -->
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-two-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-two-detail" role="tabpanel" aria-labelledby="custom-tabs-two-detail-tab">
                                    <div class="col-lg-12">
                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 mb-3" >
                                                <a href="{{ url('Penjualan/Updtransaksi')}}/{{ Request::segment(3) }}" class="btn btn-primary mr-2 float-left"><i class="fas fa-shopping-cart"></i> Ubah Detail Transaksi</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="overflow-auto" style="overflow-x:auto;">
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nama Barang</th>
                                                                <th>Nama FILE</th>
                                                                <th>Panjang</th>
                                                                <th>Lebar</th>
                                                                <th style="width: 5%;">Jumlah ORDER(pcs)</th>
                                                                <th>Harga</th>
                                                                <th>Total Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        $NO = 0;
                                                        foreach ($detail_tr AS $dtr) {
                                                            $NO = $NO + 1;
                                                            IF ($dtr->is_ukuran == "Y") {
                                                                $panjang = $dtr->panjang;
                                                                $lebar = $dtr->lebar;
                                                            } ELSE {
                                                                $panjang = '-';
                                                                $lebar = '-';
                                                            }

                                                        ?>
                                                            <tr>
                                                                <td> <?= $NO ?></td>
                                                                <td> <?= $dtr->nama_barang ?></td>
                                                                <td> <?= $dtr->nama_file ?></td>
                                                                <td class="text-center"> <?= $panjang ?></td>
                                                                <td class="text-center"> <?= $lebar ?></td>
                                                                <td class="text-center"> <?= $dtr->jumlah ?></td>
                                                                <td class="text-right"> <?=  number_format($dtr->harga,0,'','.') ?></td>
                                                                <td class="text-right"> <?= number_format($dtr->subtotal,0,'','.')  ?></td>
                                                            </tr>
                                                        <?php } ?>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- /.card-body -->
                                </div>
                            </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-two-pembayaran" role="tabpanel" aria-labelledby="custom-tabs-two-pembayaran-tab">
                                      <table class="table table-bordered table-striped">
                                      <thead>
                                            <tr>
                                              <th>Kode Pembayaran</th>
                                              <th>Tgl Pembayaran</th>
                                              <th>Nominal</th>
                                              <th>Via</th>
                                          </tr>  
                                          </thead>
                                          <tbody>
                                                @foreach($pembayaran as $bayar)
                                                <tr>
                                                    <td>#{{$bayar->kode_dokumen}}</td>
                                                    <td>{{date('d-M-Y', strtotime($bayar->created_at))}}</td>
                                                    <td>{{rupiahtampil($bayar->bayar_rp)}}</td>
                                                    <td>{{$bayar->via}}</td>
                                                </tr>
                                                @endforeach
                                          </tbody>

                                      </table>
                                    </div>
                                    <!-- <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                                    </div> -->
                                    </div>
                                </div>
                                <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="ribbon-wrapper ribbon-lg" {{$r_belum}}>
                                <div class="ribbon bg-info">
                                    Belum Lunas
                                </div>
                            </div>

                            <div class="ribbon-wrapper ribbon-lg" {{$r_hutang}}>
                                <div class="ribbon bg-warning text-lg">
                                    Piutang
                                </div>
                            </div>
                            <div class="ribbon-wrapper ribbon-lg" {{$r_lunas}}>
                                <div class="ribbon bg-success text-lg">
                                    Lunas
                                </div>
                            </div>

                            <div class="card-header">
                                <h3 class="card-title"> Form Pembayaran</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row my-2">
                                    <div class="col-lg-4 col-4">
                                        <div class="callout callout-info py-1">
                                        
                                            <p class="mb-1 font-weight-normal text-info">Total Biaya </p>
                                            <p id="display_total" id="vtotal" class="mb-1 font-weight-bold"><?=rupiahtampil($subtotal);?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                       
                                        <div class="callout callout-danger py-1">
                                            <p class="mb-1 font-weight-normal text-danger">Diskon </p>
                                            <p id="display_total" id="vdiskon" class="mb-1 font-weight-bold"><?= rupiahtampil($master->diskon)  ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                        <div class="callout callout-success py-1">
                                            <p class="mb-1 font-weight-normal text-success">Terbayar </p>
                                            <p id="display_total" id="vuang" class="mb-1 font-weight-bold"><?= rupiahtampil($master->uang_dibayar) ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                        <div class="callout callout-info py-1">
                                        <?php
                                                $totals=$master->total-$master->diskon+$master->pajak+$master->pph;
                                                ?>
                                            <p class="mb-1 font-weight-normal text-info">Total Semua </p>
                                            <p id="display_total" id="vtotal" class="mb-1 font-weight-bold"><?=rupiahtampil($totals);?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                       
                                        <div class="callout callout-danger py-1">
                                            <p class="mb-1 font-weight-normal text-danger">PPN </p>
                                            <p id="display_total" id="vdiskon" class="mb-1 font-weight-bold"><?= rupiahtampil($master->pajak)  ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                        <div class="callout callout-success py-1">
                                            <p class="mb-1 font-weight-normal text-success">PPH </p>
                                            <p id="display_total" id="vuang" class="mb-1 font-weight-bold"><?= rupiahtampil($master->pph) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if($master->status_trs==3){
                                    $formhiden='hidden';
                                }else{
                                    $formhiden='';
                                } 
                                ?>

                                <div class="row align-items-end" <?=$formhiden?>><!-- hiden -->

                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="diskon">Diskon</label>
                                            <input type="text" class="form-control form-control-sm diskon" onkeyup="hitungdiskon()" autocomplete="off" id="diskon" name="diskon" value="{{$master->diskon}}" placeholder="0">
                                        </div>
                                    </div>

                                    <?php
                                    if ($master->tr_diskon_status == 0) {
                                        $n_cheked = 'checked';
                                        $p_cheked = '';
                                    } else {
                                        $n_cheked = '';
                                        $p_cheked = 'checked';
                                    }
                                    ?>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-inline ml-0 mb-4">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="nominal" name="diskon_status" value="0" class="custom-control-input diskon_status" <?= $n_cheked ?>>
                                                <label class="custom-control-label" for="nominal">Rp</label>
                                            </div>
                                            <div class="custom-control custom-radio ml-3">
                                                <input type="radio" id="prosentase" name="diskon_status" value="1" class="custom-control-input diskon_status" <?= $p_cheked ?>>
                                                <label class="custom-control-label" for="prosentase">%</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-3">
                                            <div class="form-group">
                                            <span class="align-bottom font-weight-bold">PPN</span>
                                            </div>  
                                        </div>
                                        <div class="col-md-3 col-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm" id="ppnpersen" onkeyup="hitungppn()" name="ppnpersen" value="" placeholder="PPN(%)">
                                            </div>  
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm diskon" style="text-align:right;"  id="ppnnominal" name="ppnnominal" value="{{$master->pajak}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-3">
                                            <div class="form-group">
                                            <span class="align-bottom font-weight-bold">PPH</span>
                                            </div>  
                                        </div>
                                        <div class="col-md-3 col-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm" onkeyup="hitungpph()" id="pphpersen" name="pphpersen" value="" placeholder="PPH(%)">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm diskon" style="text-align:right;" id="pphnominal" name="pphnominal" value="{{$master->pph}}" readonly>
                                            </div>
                                        </div>
                                        <!-- Hitung -->
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                            <span class="align-bottom text-danger font-weight-bold">Subtotal</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <?php
                                                $totals=$master->total-$master->diskon+$master->pajak+$master->pph;
                                                ?>
                                                <input type="text" class="form-control form-control-sm diskon" style="text-align:right;" id="nominalsub" name="nominalsub" value="<?=$totals?>" readonly>
                                            </div>
                                        </div>
      
                                    <!-- <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="nama">Nominal Bayar</label>
                                            <input type="text font-weight-bold" class="form-control form-control-sm diskon" autocomplete="off" id="nom_bayar" onchange="nominalbayar()" name="nom_bayar" value="" placeholder="0">
                                            <small class="text-danger"></small>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="nama">Jenis Pembayaran</label>
                                            <select class='form-control form-control-sm' id='jenis_bayar' name='jenis_bayar'>

                                            <?php 
                                            if ($master->kode_pembayaran == 'Cash') { ?>
                                                    <option value="Cash">Cash / Tunai</option>
                                                    <option value="Transfer">Transfer</option>
                                                <?php } else { ?>
                                                    <option value="Transfer">Transfer</option>
                                                    <option value="Cash">Cash / Tunai</option>
                                                <?php    } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6" id="dbank">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="nama">Pilih Bank</label>
                                            <select class='form-control form-control-sm' id='bank' name='bank'>
                                                <?php
                                                $databank=DB::select("select * from tb_bank");
                                                ?>
                                                  <option value="0">Pilih Bank</option>
                                                @foreach($databank as $databnk)
                                                    <option value="{{$databnk->id}}">{{$databnk->nama_bank}} || {{$databnk->no_rekening}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="nama">Tipe Pembayaran</label>
                                            <select class='form-control form-control-sm' id='tipe' name='tipe_bayar'>

                                            <option value="Tunai">Tunai</option>
                                            <option value="Kredit">Kredit</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="nama">Tempo Pembayaran</label>
                                            <select class='form-control form-control-sm' id='tipe' name='tempo'>
                                            <?php
                                                $termin=DB::select("select * from tb_termin");
                                                ?>
                                                  <option value="0">Pilih Termin</option>
                                                @foreach($termin as $tmin)
                                                    <option value="{{$tmin->id}}">{{$tmin->termin}} || {{$tmin->waktu}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                     <?php
                                     if($master->status_trs>1 and $master->status_dok==1){
                                    ?>
                                    <div class="col-lg-12">
                                         <div class="alert alert-success" role="alert">
                                             <p class="text-justify"> <strong>Informasi,</strong> Anda dapat melakukan Konfirmasi pengambilan cetakan dengan menekan tombol dibawah ini</p>
                                             <hr>
                                             <div class="row">
                                                 <div class="col-lg-12">
                                                     <a href="{{url('Penjualan/actionAmbil/')}}/{{$master->kode_penjualan}}" class="btn btn-primary float-right"><i class="fas fa-handshake"> </i> Konfirmasi Pengambilan</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                    <?php
                                     }
                                     ?>
                                    <?php
                                   if( $master->status_dok==2){
                                    $ts_ambil = strtotime($master->tr_tgl_selesai);
                                    $dt_ambil = date('Y-m-d', $ts_ambil);
                                    $tgl_ambil = date($dt_ambil);
                                    $jam_ambil = date('H:i', $ts_ambil);
                                   
                                  
                                    ?>
                                    <div class="col-lg-12">
                                        <div class="alert alert-info" role="alert">
                                            <p class="text-justify"> <strong>Informasi,</strong> Transaksi ini sudah diambil oleh pelanggan pada tanggal <strong> <?= $tgl_ambil ?></strong> dan pukul <strong><?= $jam_ambil ?></strong></p>
                                        </div>
                                    </div>
                                    <?php
                                   }
                                   ?>
                                    <div class="col-lg-12">
                                        <div class="alert alert-info" role="alert" {{$r_belum}}>
                                            <p class="text-justify"> <strong>Informasi !</strong> Pengambilan barang dapat dilakukan jika pembayaran transaksi sudah mencapai <strong>KELUNASAN</strong> atau transaksi sudah terkonfirmasi sebagai <strong>HUTANG</strong> </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-1">
                                        <?php
                                        if($master->status_trs!=3){
                                            echo '  <button type="submit" name="submit" value="1" class="btn btn-success btn-icon-split float-right ml-2" >
                                            <span class="text">Simpan</span>
                                        </button>';
                                        }
                                        ?>
                                    
                                      
                                        <a href="{{url('Penjualan/printNotaKecil/')}}/{{ Request::segment(3) }}" target="_blank" class="btn btn-primary float-right ml-2"> Surat Jalan</a>
                                        <a href="{{url('Penjualan/printNotaBesar/')}}/{{ Request::segment(3) }}" target="_blank" class="btn btn-primary float-right"> Invoice</a>

                                    </div>
                                </div>

                            </div>

                            <!-- /.card-body -->
                        </div>

                    </div>

                </div>


        </div>
        </form>
    </section>
    <!-- /.content -->
</div>

@include('Tag')

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ url('assets/plugins/toastr/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/jquery.price_format.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
      var $subtotal=<?=$subtotal?>;
    $(function() {

        $('.diskon').priceFormat({
            prefix: '',
            centsLimit: 0,
            thousandsSeparator: '.',
        });

    });

    $(function() {
        $('#diskon').priceFormat({
            prefix: '',
            centsLimit: 0,
            thousandsSeparator: '.',
        });
    });
</script>

<script>
    $('.konfirmasi-hapus').on('click', function(e) {
        // alert('terpencet');
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Akan menghapus transaksi atas nama ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    });


    function hitungppn(){

        var value = document.getElementById("ppnpersen").value;
        var $hitung=value*$subtotal/100;
        document.getElementById("ppnnominal").value = $hitung;

        $('#ppnnominal').priceFormat({
            prefix: '',
            centsLimit: 0,
            thousandsSeparator: '.',
        });
    }

    function hitungpph(){
      
        var value = document.getElementById("pphpersen").value;
        var $hitung=value*$subtotal/100;
        document.getElementById("pphnominal").value = $hitung;

        $('#pphnominal').priceFormat({
            prefix: '',
            centsLimit: 0,
            thousandsSeparator: '.',
        });
    }    

function hitungdiskon(){
    var radios = document.getElementsByName('diskon_status');
    var value = document.getElementById("diskon").value;
    var intbayar=value.replace('.','');
    var $sekaliandiskon=0;
    for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked) {

        if(radios[i].value==1){
           var hitungdiskonku= intbayar*$subtotal/100;
           $sekaliandiskon=$subtotal-hitungdiskonku;
        }else{
            $sekaliandiskon=$subtotal-intbayar;
        }
        document.getElementById("nominalsub").value=$sekaliandiskon;
        // console.log($sekaliandiskon);
    break;

  }
  
}
    
}

function nominalbayar(){
    var value = document.getElementById("nom_bayar").value;
    var intbayar=value.replace('.','');
    // if(intbayar<$subtotal){
    //     alert('Nominal Kurang');
    // }
}
</script>
@include('Foot')