@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fa fa-cubes nav-icon"></i> Pelunasan Piutang</h1>

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
                                <div class=" col-lg-8 col-12 ">
                                            
                                                    <a class="btn btn-sm btn-info float-left mt-3 mr-2" href="CreatePelunasan" <?=aktifbaru($butons['baru']);?>><i class="fas fa-plus"></i> Baru</a>
                                <button class="btn btn-sm btn-primary float-left mt-3 mr-2" onclick="tampilFormWaktu()"> <i class="fas fa-filter"></i> Pencarian</button>
                                            </div>
                                
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                        <!-- <hr> -->
                                <table class="table table-bordered table-hover table-sm table-pilihan">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NO DOKUMEN</th>
                                                <th>TANGGAL</th>
                                                <th>TGL PEMBAYARAN</th>
                                                <th>NO REFF</th>
                                                <th>PEMBAYARAN</th>
                                                <th>NAMA CUSTOMER</th>
                                                <th>NOMINAL</th>
                                                <th>STATUS</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                      <tbody class="data-recev">
                                        @php
                                        $nm=0;
                                        @endphp
                                      @foreach($hariini as $hr)
                                      <tr>
                                                <td>#</td>
                                                <td>{{$hr->no_dokumen}}</td>
                                                <td>{{$hr->tgl_dokumen}}</td>
                                                <td>{{date('d-M-Y', strtotime($hr->tgl_cair))}}</td>
                                                <td>{{$hr->no_reff}}</td>
                                                <td>{{$hr->cara_bayar}}</td>
                                                <td>{{$hr->customer->nama_konsumen}}</td>
                                                <td class="text-right">{{rupiahtampil($hr->jumlah_rp)}}</td>
                                                <td><span class="badge bg-success">{{$hr->status_dok}}</span></td>
                                                <td>#</td>
                                            </tr>
                                            @php
                                            $nm+=$hr->jumlah_rp;
                                            @endphp
                                      @endforeach
                                      
                                        </tbody>
                                    </table>
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
                                                <label>Segmentasi</label>
                                                <select class="form-control form-control-sm" name="segmentasi">
                                                <option value='Cabang|Instansi|Retail|Rese'>Semua</option>
                                                <option value='Cabang'>Cabang</option>
                                                <option value='Instansi'>Instansi</option>
                                                <option value='Retail'>Retail</option>
                                                <option value='Rese'>Reseller</option>
                                                 
                                                </select>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label>Konsumen</label>
                                                <select class="form-control form-control-sm select2" name="nama_konsumen">
                                                    <option value='-'>Semua</option>
                                                    @foreach($konsumen as $ks)
                                                    <option value='{{$ks->kode_konsumen}}'>{{$ks->nama_konsumen}}</option>
                                                    @endforeach
                                                </select>
                                            </div> -->
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
              <button type="button" class="btn btn-primary" onclick="prosescustom()">Proses</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('Tag')
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
<script src="{{ url('assets/css/sortd.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ url('assets/dist/js/adminlte.js')}}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script>
  $('.select2').select2({theme: 'bootstrap4'})

function tampilFormWaktu(){
        $('#modal-waktu').modal('show');
    }

    function prosescustom(){
        var time1 = document.getElementById('tgl_awal').value;
        var time2 = document.getElementById('tgl_akhir').value;
        var kons = $('[name=nama_konsumen]').val();
        var segmen = $('[name=segmentasi]').val();

        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                url: "{{url('Pelunasan/GetLunas/')}}",
                method: "POST",
                    data: {
                                konsumen: kons,
                                segm: segmen,
                                tgl1:time1,
                                tgl2:time2,
                            },
                success: function(data) {
                    $('.data-recev').html('<tr><td colspan="4"> <center>Sedang memuat data...  <i class="fas fa-hourglass-start fa-spin"></i></center></td></tr>');
                    $('.data-recev').html(data);
             
                }
            });
    }
function trash(id){
    
    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    // Swal.fire(
    //   'Deleted!',
    //   'Your file has been deleted.',
    //   'success'
    // )
    alert(id);
  }
})
}
</script>
</body>
  </html>