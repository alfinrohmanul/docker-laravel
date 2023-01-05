@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fa fa-cubes nav-icon"></i> Pelunasan</h1>

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
                        <div class="col-md-3">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header ui-sortable-handle" style="background-color:#15489B;">
                                    <text class="text-white">Buat Baru</text>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">

                                        <div class="col-lg-12 col-12">
                                            <div class="form-group" id="id-outlet-parent">
                                                <label class="col-form-label-sm" for="diskon">No Transaksi</label>
                                                <select class="form-control form-control-sm select2" name="kode_outlet"
                                                    onchange="pilihTransaksi()">
                                                   @foreach($hutang as $bayar)
                                                   <option value="{{$bayar->kode_penjualan}}">{{$bayar->no_penjualan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                    <div class="card">
                        <div class="card-header ui-sortable-handle" style="background-color:#15489B;">
                             <text class="text-white">Daftar Transaksi</text>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="Pelunasan/Bayar" method="post">
                            {{ csrf_field() }}
                            <div class="panel-body table-responsive" style="max-height: 400px;">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nama Customer</th>
                                            <th>Tgl Order</th>
                                            <th>Total</th>
                                            <th>Via</th>
                                            <th>Terbayar</th>
                                            <th>Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbBarangList">
                                        <tr>
                                            <td colspan="6" class="text-center font-italic"> Silahkan pilih No transaksi
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="row">
                                <!-- <div class="form-group">
                                    <label for="tt">Total</label>
                                    <input class="form-control form-control-sm text-right" type="text"
                                        placeholder="total" id="tty" name="tty" autocomplete="off" readonly>
                                </div> -->
                                <div class="col mt-3">
                                    <button type="submit" class="btn btn-primary float-right"
                                        id="konfirmasi">Konfirmasi</button>
                                    <button type="button" class="btn btn-outline-secondary float-right mr-3"
                                        data-dismiss="modal"> Batal</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                    </div>
                    <!-- /.row -->
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('Tag')
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="{{ url('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/jquery.price_format.min.js')}}"></script>
<script>
 $('.select2').select2({theme: 'bootstrap4'})

function pilihTransaksi(){
        var id=$('[name=kode_outlet]').val();
        Swal.fire('Loading');
        Swal.showLoading();
        
        $('#tbBarangList').load("Pelunasan/Transaksi/" + id);
        Swal.close()
}

function nanas(){
    console.log('tayo');
}
</script>
@include('Foot')