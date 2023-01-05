@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-file-invoice nav-icon"></i> Laporan Piutang</h1>

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
                                    <text class="text-white">Laporan Transaksi Piutang</text>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row mb-3 align-items-center">
                                        
                                       
                                        <div class=" col-lg-8 col-12 ">
                                                    <button class="btn btn-sm btn-primary float-left mt-3 mr-2" onclick="tampilFormWaktu()"> <i class="fas fa-filter"></i> Pencarian</button>
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
                <div class="col-lg-12 col-12">
                    <div class="form-group">
                        <label>Pilih Konsumen</label>
                            <select class='form-control form-control-sm select2' name='namakonsumen'>
                                <option value='-'>Semua</option>
                                @foreach($konsumen as $namakonsu)
                                    <option value='{{$namakonsu->kode_konsumen}}'>{{$namakonsu->nama_konsumen}}</option>
                                @endforeach
                            </select>
                    </div>
                </div>
                <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label>Pilih segmentasi</label>
                                                <select class='form-control form-control-sm' name='segmentasi'>
                                                    <option value='Cabang|Instansi|Retail|Rese'>Semua</option>
                                                    @foreach($segmen as $segmentas)
                                                        <option value='{{$segmentas->segmentasi}}'>{{$segmentas->segmentasi}}</option>
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
            <form action="expiutang" method="POST" >
                {{ csrf_field() }}
            <div class="row">
            <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label>Pilih segmentasi</label>
                                                <select class='form-control form-control-sm' name='segmentasi'>
                                                    <option value='Cabang|Instansi|Retail|Rese'>Semua</option>
                                                    @foreach($segmen as $segmentas)
                                                        <option value='{{$segmentas->segmentasi}}'>{{$segmentas->segmentasi}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
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
                <button type="submit" class="btn btn-success float-left"> <i class="fas fa-file-excel"></i> Laporan Piutang</button>
               
            </div>
</form>
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

<!-- jQuery UI 1.11.4 -->
<script src="{{ url('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ url('assets/dist/js/adminlte.js')}}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script>
  $('.select2').select2({theme: 'bootstrap4'})
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
        var cust = $('[name=namakonsumen]').val();
        var segmen = $('[name=segmentasi]').val();;

        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                url: "{{url('Laporan/Getlaporanpiutang/')}}",
                method: "POST",
                data: {
                    cust: cust,
                    tgl1:time1,
                    tgl2:time2,
                    segmen:segmen,
                },
                success: function(data) {
                    $('#view_tabel').html('<tr><td colspan="4"> <center>Sedang memuat data...  <i class="fas fa-hourglass-start fa-spin"></i></center></td></tr>');
                    $('#view_tabel').html(data);
                    // console.log(data);
                }
            });
    }
    
    // function callcetak(){
    //     var awal=document.getElementById('awalu').value ;
    //     var akir=document.getElementById('akhiru').value;
    //     var segmen = $('[name=segmentasi]').val();;
    //     // window.open('expiutang/'+awal+'/'+akir,'_blank');

    //     $.ajax({
    //             headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //             url: "{{URL::to('Laporan/expiutang')}}",
    //             method: "POST",
    //             data: {
    //                 tgl1:awal,
    //                 tgl2:akir,
    //                 segmen:segmen,
    //             },
    //             success: function(response) {
    //                 var a = document.createElement("a");
    //                 // a.href = response.file;
    //                 a.download = response;
    //                 document.body.appendChild(a);
    //                 alert('success excel downloaded');
                    
    //             }
    //         });
    // }

    function tampilFormWaktu(){
        $('#modal-waktu').modal('show');
    }

    function viewModalExcel(id) {
        $('#modal-excel').modal('show');
    }
</script>

@include('Foot')