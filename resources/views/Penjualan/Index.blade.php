@include('Head')
@include('Menu')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><i class="fas fa-shopping-cart nav-icon"></i> Penjualan</h1>

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
                            <h5>Transaksi Baru</h5>

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
                    <a href="Penjualan/transaksiBelumLunas/2" class="small-box bg-danger">
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

            <div class="col-lg-12">
                <div class="card">
                                <div class="card-header ui-sortable-handle" style="background-color:#15489B;">
                                    <text class="text-white">Transaksi</text>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive ">

                                <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                        <tr>
                                                <th>#</th>
                                                <th>NO PENJUALAN</th>
                                                <th>NAMA KONSUMEN</th>
                                                <th>TANGGAL MASUK</th>
                                                <th>STATUS DOKUMEN</th>
                                                <th>TOTAL</th>
                                                <th>TERBAYAR</th>
                                                <th>SISA</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                      <tbody>
                                      
                                        </tbody>
                                    </table>
                                </div>
                            </div>
            </div>
</div>
    <!-- /.modal -->
    <div id="modal-pelanggan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Input Transaksi Baru</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <disv class="modal-body">
                            <form action="Penjualan/TransaksiBaru" method="POST">
                            {{ csrf_field() }}
                                    <div class="row">
                                   
                                        <div class="col-lg-12">
                                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                <div>
                                                <i>Pilih Konsumen jika sudah terdaftar</i>
                                                </div>
                                            </div>  
                                            <div class="form-group" id="id-karyawan-parent" >
                                                <select class="form-control form-control-sm select2" onchange="pilihcst()" name="kode_konsumen" >
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
                                                <input type="text" autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" class="form-control form-control-sm" placeholder="Nama Konsumen..." name="nama_konsumen" required>
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
                                            <label for="sabar">Segmentasi</label>
                                            <select class="form-control form-control-sm" name="segmentasi" required>
                                                <option value="Retail">Retail</option>
                                                <option value="Reseller">Reseller</option>
                                                <option value="Instansi">Instansi</option>
                                                <option value="Cabang">Cabang</option>
                                            </select>
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

    <div class="modal fade" id="modal-print">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Print</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="form-print">
            
            </div>
            <!-- <div class="modal-footer justify-content-between">
            <a href="exlaporan" class="btn btn-success btn-sm float-left"> <i class="fas fa-file"></i> Invoice</a>
            <a href="exlaporandetail" class="btn btn-success btn-sm float-right"> <i class="fas fa-file"></i> Surat Jalan</a>

            </div> -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  </section>
  <!-- /.content -->
</div>

@include('Tag')

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>

$('.select2').select2({theme: 'bootstrap4'})
    
</script>
<script>
    function inputPelanggan() {
        $('#modal-pelanggan').modal('show');
    }

function pilihcst(){
        var value = $('[name=kode_konsumen]').val();
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
}
        

        
 

    var tabel = null;
    $(document).ready(function() {
        tabel = $('#example1').DataTable({
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 3, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax":
            {
                "url": "{{ url('Penjualan/AllPenjualan')}}", // URL file untuk proses select datanya
            },
            "deferRender": true,
            "aLengthMenu": [[ 25, 50, 100],[ 25, 50, 100]], // Combobox Limit
            "columns": [
                {"data": 'kode_penjualan',"sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                { "data": "no_penjualan" }, 
                { "data": "nama_konsumen" },  
                { "data": "tgl_penjualan" },  
                { "data": "statustransaksi" },
                { "data": "total"}, 
                { "data": "uang_dibayar" },  
                { "data": "sisa" },
                { "data": "kode_penjualan" ,
                    render: function (data, type, row, meta) {
                        var beta="'"+data+"'";
                        return '<button type="button" onclick="viewDetail('+beta+')" class="btn btn-warning btn-xs"><i class="fas fa-print"></i></i></button>';
                    }  
                    },    
            ],
        });
    });

    function viewDetail(id) {
        $('#modal-print').modal('show');
        // alert(id);
        $('#form-print').load("{{ url('Spk/GetSpk/')}}/" + id);
    }
</script>
@include('Foot')