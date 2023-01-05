@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-file-invoice nav-icon"></i> Laporan Cetak</h1>

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
                                    <text class="text-white">Laporan Transaksi Percetakan</text>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row mb-3 align-items-center">
                                    <div class="col-lg-2 col-12">
                                            <div class="form-group">
                                                <label>Status Transaksi</label>
                                                <select class='form-control form-control-sm' id='trans' name='trans'>
                                                    <option value='1|2|3'>Semua</option>
                                                    <option value='3'>Lunas</option>
                                                    <option value='2'>Piutang</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-12">
                                            <div class="form-group">
                                                <label>Pilih Kasir</label>
                                                <select class='form-control form-control-sm' id='nama_kasir' name='nama_kasir'>
                                                    <option value='-'>Semua</option>
                                                    @foreach($kasir as $namakasir)
                                                    <option value='{{$namakasir->id}}'>{{$namakasir->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-12">
                                            <div class="form-group">
                                                <label>Pilih Shift</label>
                                                <select class='form-control form-control-sm' id='shift' name='shift'>
                                                    <option value='-'>Semua</option>
                                                    <option value='1'>08:00 - 16:00</option>
                                                    <option value='2'>16:00 - 21:00</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-12">
                                            <div class="form-group">
                                                <label>Pilih segmentasi</label>
                                                <select class='form-control form-control-sm' id='segmentasi' name='segmentasi'>
                                                    <option value='Cabang|Instansi|Retail|Rese'>Semua</option>
                                                    @foreach($segmen as $segmentas)
                                                        <option value='{{$segmentas->segmentasi}}'>{{$segmentas->segmentasi}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" col-lg-8 col-12 ">
                                            <button  class="btn btn-sm btn-primary float-left mt-3 mr-2" onclick="pembelianHariIni()"> <i class="fas fa-calendar-day"></i> Hari Ini</button>
                                                    <button class="btn btn-sm btn-primary float-left mt-3 mr-2" onclick="tampilFormWaktu()"> <i class="fas fa-calendar"></i> Waktu Custom</button>
                                                    <!-- <a href="exlaporan" class="btn btn-sm btn-warning float-left mt-3 mr-2" > <i class="fas fa-file-excel"></i> Download</a> -->
                                                    <button onclick="viewModalExcel()" class="btn btn-sm btn-warning float-left mt-3 mr-2" > <i class="fas fa-file-excel"></i> Download</button>
                                                     <!-- <button class="btn btn-sm btn-success float-left mt-3 mr-2" onclick="sendwhatsap()"> <i class="fab fa-whatsapp"></i> Laporan WhatsApp</button> -->
                                            </div>
                                        </div>
                                        <div class="row" id="view_tabel">

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

                <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label>Pilih segmentasi</label>
                                                <select class='form-control form-control-sm' id="segmennya" name='segmentasi'>
                                                    <option value='Cabang|Instansi|Retail|Rese'>Semua</option>
                                                    @foreach($segmen as $segmentas)
                                                        <option value='{{$segmentas->segmentasi}}'>{{$segmentas->segmentasi}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
            </div>
            <hr>
                <!-- <a href="exlaporan" class="btn btn-success float-left"> <i class="fas fa-file-excel"></i> Laporan Transaksi (Simple)</a>
                <a href="exlaporandetail" class="btn btn-success float-right"> <i class="fas fa-file-excel"></i> Laporan Transaksi (Detail)</a> -->
                <button onclick="callcetak()" class="btn btn-success float-left"> <i class="fas fa-file-excel"></i> Laporan Cetak (Simple)</button>
                <button onclick="callcetakdetail()" class="btn btn-success float-right"> <i class="fas fa-file-excel"></i> Laporan Transaksi (Detail)</button>

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

    function pembelianHariIni() {
        var time1 = "<?= date('Y-m-d') ?>";
        var time2 = "<?= date('Y-m-d') ?>";
        var s_bayar = document.getElementById('nama_kasir').value;
        var sift = document.getElementById('shift').value;
        var statusb = document.getElementById('trans').value;
        var segmen = document.getElementById('segmentasi').value;
        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                url: "{{url('Laporan/tampilDataTransaksi/')}}",
                method: "POST",
                data: {
                    kasir: s_bayar,
                    tgl1:time1,
                    tgl2:time2,
                    shift:sift,
                    status:statusb,
                    segment:segmen,
                },
                success: function(data) {
                    // console.log(data);
                    $('#view_tabel').html('<tr><td colspan="4"> <center>Sedang memuat data...  <i class="fas fa-hourglass-start fa-spin"></i></center></td></tr>');
                    $('#view_tabel').html(data);
                    // console.log(data);
                }
            });
    }

    function pembelianCustom() {
        var time1 = document.getElementById('tgl_awal').value;
        var time2 = document.getElementById('tgl_akhir').value;
        var s_bayar = document.getElementById('nama_kasir').value;
        var sift = document.getElementById('shift').value;
        var statusb = document.getElementById('trans').value;
        var segmen = document.getElementById('segmentasi').value;

        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                url: "{{url('Laporan/tampilDataTransaksi/')}}",
                method: "POST",
                data: {
                    kasir: s_bayar,
                    tgl1:time1,
                    tgl2:time2,
                    shift:sift,
                    status:statusb,
                    segment:segmen,
                },
                success: function(data) {
                    $('#view_tabel').html('<tr><td colspan="4"> <center>Sedang memuat data...  <i class="fas fa-hourglass-start fa-spin"></i></center></td></tr>');
                    $('#view_tabel').html(data);
                    // console.log(data);
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

    function callcetak(){
        var awal=document.getElementById('awalu').value ;
        var akir=document.getElementById('akhiru').value;
        var segmen = document.getElementById('segmennya').value;

        window.open('exlaporan/'+awal+'/'+akir+'/'+segmen,'_blank');

        // console.log(segmen);
    }
    function callcetakdetail(){
        var awal=document.getElementById('awalu').value ;
        var akir=document.getElementById('akhiru').value;
        var segmen = document.getElementById('segmennya').value;

        window.open('exlaporandetail/'+awal+'/'+akir+'/'+segmen,'_blank');
    }

    function viewModalExcel(id) {
        $('#modal-excel').modal('show');
    }
</script>

@include('Foot')