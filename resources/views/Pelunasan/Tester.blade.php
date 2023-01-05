@include('Head')
@include('Menu')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark"><i class="fa fa-cubes nav-icon"></i> Pelunasan</h1>
          </div>
      
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="alert alert-warning alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5><i class="icon fas fa-exclamation-triangle"></i> Informasi!</h5>
Silahkan di Ceklis Yang akan di bayarkan
</div>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Informasi Peluansan</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="nopelunasan">No Pelunasan</label>
                <input type="text" name="nopelunasan" class="form-control form-control-sm" value="{{$kode_u}}" readonly>
              </div>
              <div class="form-group">
                <label for="inputStatus">Nama Akun</label>
                <select id="inputStatus" name="kodeakun" class="form-control form-control-sm select2">
                  @foreach($akun as $akn)
                  <option value="{{$akn->kode_akun}}">{{$akn->nama_akun}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggallunas" id="tanggallunas" class="form-control form-control-sm">
              </div>
              <div class="form-group">
                <label for="cust">Nama Customer</label>
                <select id="cust" name="kodekonsumen" class="form-control form-control-sm select2" onchange="pilihcst()">
                  @foreach($konsumen as $cst)
                  <option value="{{$cst->kode_konsumen}}">{{$cst->nama_konsumen}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="bayars">Pembayaran</label>
                <select name="bayars" class="form-control form-control-sm">
                  <option value="Tunai">Tunai</option>
                  <option value="Transfer">Transfer</option>
                </select>
              </div>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-8">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Detail Transaksi</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>No Transaksi</th>
                    <th>Tanggal</th>
                    <th class="text-right">Total</th>
                    <th class="text-right">Sisa</th>
                    <th>#</th>
                    <th class="text-right">Bayar</th>
                  </tr>
                </thead>
                <tbody id="detailtr">
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Kembali</a>
          <button type="button" class="btn btn-primary float-right" id="konfirmasi">Simpan</button>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

@include('Tag')

</div>
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
   $('.select2').select2({theme: 'bootstrap4'})
</script>

<script>
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  var date = new Date();
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();

  if (month < 10) month = "0" + month;
  if (day < 10) day = "0" + day;

  var today = year + "-" + month + "-" + day;


document.getElementById('tanggallunas').value = today;
  function pilihcst(){
    var value = $('[name=kodekonsumen]').val();
        Swal.fire('Loading');
        Swal.showLoading();

        $.ajax({
            url: "PelunasanUpdate/"+value,
            success: function(data) {
               $('#detailtr').html(data);
                // console.log(data.nama_konsumen);
                swal.close()
            }
        });
  }

  $(document).ready(function() {
    $("#konfirmasi").click(function() {
        var trs = $('table tr');
        var values = trs.first().find('td');

        var values1 = $('table tr td :checkbox:checked').map(function() {
            return $(this).closest('tr').find("td[contentEditable='false']").text() + "z" +
            $(this).closest('tr').find('[name=bayaran]').val();
        }).get();

        var nopelunasan = $('[name=nopelunasan]').val();
        var kodeakun = $('[name=kodeakun]').val();
        var tanggal = $('[name=tanggallunas]').val();
        var konusmen = $('[name=kodekonsumen]').val();
        var pembayaran = $('[name=bayars]').val();
     
        // console.log(values1);
        Swal.fire('Loading');
        Swal.showLoading();
        $.ajax({
            type: 'post',
            url: 'Tester',
            dataType: 'json',
            data: {
              nopelunasan: nopelunasan,
              kodeakun: kodeakun,
              tanggal: tanggal,
              konusmen: konusmen,
              pembayaran: pembayaran,
              id: values1,
              _token: CSRF_TOKEN
            },
            // beforeSend: function(e) {
            //     if (e && e.overrideMimeType) {
            //         e.overrideMimeType("application/json;charset=UTF-8");
            //     }
            // },
            success: function(response) {
                swal.close()
                Swal.fire(
                    'Tersimpan!',
                    'Terlunaskan',
                    'success'
                )
                // console.log(response);
                window.location.href = "{{url('PelunasanPiutang')}}";
            }
                        ,
             error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                        }

        })

    });
});


  </script>
 

@include('Foot')