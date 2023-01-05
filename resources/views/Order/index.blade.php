@include('Head')
@include('Menu')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><i class="fa fa-shopping-bag nav-icon"></i> Permintaan Order</h1>

        </div><!-- /.col -->

      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
    <div class="row">
                <div class="col-lg-12">
                    
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <a href="#" class="small-box bg-secondary py-2" onclick="inputPelanggan()">
                        <div class="inner">
                            <h4 class="mt-3">Input</h4>
                            <h5>Permintaan Order</h5>

                            <p> </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-medical"></i>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <a href="Penjualan/transaksiBelumDiambil/1" class="small-box bg-info">
                        <div class="inner">
                            <h3 class="mt-3">{{$belumdiambil[0]->totalambil}}</h3>
                            <h5>Transaksi Belum Diambil</h5>

                            <p> </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <a href="Penjualan/transaksiBelumDiambil/2" class="small-box bg-success">
                        <div class="inner">
                            <h3 class="mt-3">{{$totalambil}}</h3>
                            <h5>Transaksi Sudah Diambil</h5>

                            <p> </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <a href="Penjualan/transaksiBelumDiambil/4" class="small-box bg-danger">
                        <div class="inner">
                            <h3 class="mt-3">{{$hutang}}</h3>
                            <h5>Transaksi Belum Lunas</h5>

                            <p> </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div id="modal-pelanggan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Input Transaksi Baru</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="Penjualan/TransaksiBaru" method="POST">
                            {{ csrf_field() }}
                                    <div class="row">
                                   
                                        <div class="col-lg-12">
                                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                <div>
                                                <i>Pilih Konsumen jika sudah terdaftar</i>
                                                </div>
                                            </div>  
                                            <div class="form-group" id="id-karyawan-parent" ></div>
                                                <select class='form-control form-control-sm' id='id-karyawan' name="kode_konsumen" >
                                                    <option value=""> Cari Konsumen <option>
                                                @foreach($konsumen as $k=>$list)
                                                    <option value="{{$list->kode_konsumen}}">{{$list->no_konsumen}} || {{$list->nama_konsumen}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <hr>    
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="nama">Nama Konsumen</label>
                                                <input type="text" autocomplete="off" class="form-control form-control-sm" placeholder="Nama Konsumen..." name="nama_konsumen" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="nama">Nomor HP</label>
                                                <input type="text" autocomplete="off" class="form-control form-control-sm" placeholder="0821..." name="no_hp" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="nama">Alamat</label>
                                                <textarea class="form-control" rows="3" placeholder="Alamat ..." name="alamat" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="modal-footer justify-content-between px-0">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                    </div>
</form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
					</div>

                <!-- /.modal-dialog -->
            </div>
    </div>

    <!-- /.modal -->
  </section>
  <!-- /.content -->
</div>

<footer class="main-footer">
  <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">WAHANA</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> <?php echo date('M'); ?>
  </div>
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

    $(function() {
        $('#id-karyawan').select2({
            width: '100%', 
            dropdownParent: $('#modal-pelanggan')
        });

    });
    
</script>
<script>
    function inputPelanggan() {
        $('#modal-pelanggan').modal('show');
    }

    $('#id-karyawan').change(function(){ 
        var value = $(this).val();
        Swal.fire('Loading');
        Swal.showLoading();
        $.ajax({
            url: "Penjualan/GetKonsumen/"+value,
            success: function(data) {
                $('[name=nama_konsumen]').val(data.nama_konsumen);
                $('[name=no_hp]').val(data.no_hp);
                $('[name=alamat]').val(data.alamat);
                // console.log(data.nama_konsumen);
                swal.close()
            }
        });
    });
</script>
@include('Foot')