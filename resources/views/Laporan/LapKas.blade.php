@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-file-invoice nav-icon"></i> Laporan Kas</h1>

                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- /.card -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header ui-sortable-handle" style="background-color:#15489B;">
                                    <text class="text-white">Laporan Kas</text>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row mb-3 align-items-center">
                                        
                                       
                                        <div class=" col-lg-8 col-12 ">
                                                    <button class="btn btn-sm btn-primary float-left mt-3 mr-2" onclick="tampilFormWaktu()"> <i class="fas fa-filter"></i> Pencarian</button>
                                                    <button onclick="viewModalExcel()" class="btn btn-sm btn-warning float-left mt-3 mr-2" > <i class="fas fa-file-excel"></i> Download / Print</button>
                                                    <!-- <button class="btn btn-sm btn-primary float-left mt-3 mr-2" onclick="cetak()"> <i class="fas fa-print"></i> Cetak Laporan Harian</button> -->
                                                     <!-- <button class="btn btn-sm btn-success float-left mt-3 mr-2" onclick="sendwhatsap()"> <i class="fab fa-whatsapp"></i> Laporan WhatsApp</button> -->
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-12 col-12">
                                                <div class="overflow-auto" style="overflow-x:auto;">
                                                                <table class="table table-bordered table-striped table-pilihan">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>No Dokumen</th>
                                                                            <th>Tanggal</th>
                                                                            <th>Tanggal Pembayaran</th>
                                                                            <th>No Reff</th>
                                                                            <th>Via</th>
                                                                            <th>Nama Konsumen</th>
                                                                            <th>Terbayar</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="data-recev">
</tbody>
</table>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!--/.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
        <div class="modal fade" id="modal-waktu">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tanggal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="row">
            <div class="col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Pilih Kas</label>
                                                <select class='form-control form-control-sm' id='bank' name='bank'>
                                                    <option value='-'>Semua</option>
                                                    @foreach($bank as $namakonsu)
                                                    <option value='{{$namakonsu->id}}'>{{$namakonsu->nama_bank}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="nabar">Tanggal Awal</label>
                        <input class="form-control form-control-sm" type="date" id="tgl_awal" name="tgl_awal" autocomplete="off">
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="nabar">Tanggal Akhir</label>
                        <input class="form-control form-control-sm" type="date" id="tgl_akhir" name="tgl_akhir" autocomplete="off">
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="pembelianCustom()">Proses</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-excel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Pilih Tipe Laporan Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="nabar">Tanggal Awal</label>
                        <input class="form-control form-control-sm" type="date" id="awalu" name="awalu" autocomplete="off">
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="nabar">Tanggal Akhir</label>
                        <input class="form-control form-control-sm" type="date" id="akhiru" name="akhiru" autocomplete="off">
                    </div>
                </div>
            </div>
            <hr>
                
                <button onclick="callcetak()" class="btn btn-success float-left"> <i class="fas fa-file-excel"></i> Laporan Kas (Simple)</button>
                <button onclick="cetak()" class="btn btn-primary float-right"> <i class="fas fa-print"></i> Cetak Laporan Kas</button>

            </div>
        </div>
    </div>
</div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('Tag')

<!-- Control Sidebar -->

<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="{{ url('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ url('assets/css/sortd.js')}}"></script>

<script>

var date = new Date();

var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;


document.getElementById('tgl_awal').value = today;
document.getElementById('tgl_akhir').value = today;
document.getElementById('awalu').value = today;
document.getElementById('akhiru').value = today;
   

    function pembelianCustom() {
        var time1 = document.getElementById('tgl_awal').value;
        var time2 = document.getElementById('tgl_akhir').value;
        var s_bayar = document.getElementById('bank').value;

        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                url: "{{url('Laporan/Getkas/')}}",
                method: "POST",
                    data: {
                                kasir: s_bayar,
                                tgl1:time1,
                                tgl2:time2,
                            },
                success: function(data) {
                    $('#view_tabel').html('<tr><td colspan="4"> <center>Sedang memuat data...  <i class="fas fa-hourglass-start fa-spin"></i></center></td></tr>');
                    $('.data-recev').html(data);
             
                }
            });
    }
    
    function sendwhatsap(){
        var thlnow="<?= date('d-m-Y') ?>";
        var header = '%5B%60%60%60LAPORAN+WAHANA+SATRIA%60%60%60+' +
            '+%60%60%60TANGGAL%60%60%60+'+thlnow+'%5D%0D%0A%0D%0A'

            window.open(
            'https://api.whatsapp.com/send?phone=6285294794747&text=' + header ,
            '_blank'
        );
    }

    function tampilFormWaktu(){
        $('#modal-waktu').modal('show');
    }
    function viewModalExcel(id) {
        $('#modal-excel').modal('show');
    }
    function cetak(){
        var time1 = document.getElementById('awalu').value;
        var time2 = document.getElementById('akhiru').value;

        window.open('Cetakhariini/'+time1+'/'+time2,'_blank');
    }

    function callcetak(){
        var awal=document.getElementById('awalu').value ;
        var akir=document.getElementById('akhiru').value;

        window.open('Penerimaan/'+awal+'/'+akir,'_blank');
    }
</script>

@include('Foot')