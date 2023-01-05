@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-list nav-icon"></i> List Belum Lunas</h1>
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
                                    <text class="text-white">List</text>

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
        <div class="modal fade" id="modal-detail">


<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Detail Transaksi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="form-detail">


        </div>
        <!-- /.modal-content -->
    </div>

    <!-- /.modal-dialog -->
</div>
</div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; <?=date('Y')?> <a href="#">WAHANA</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0.0
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="{{ url('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ url('assets/plugins/toastr/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/jquery.price_format.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<script>

var tabel = null;
    $(document).ready(function() {
        tabel = $('#example1').DataTable({
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax":
            {
                "url": "{{ url('Penjualan/ListTransaksiBelumlunas')}}/{{ Request::segment(3) }}", // URL file untuk proses select datanya
            },
            "deferRender": true,
            "aLengthMenu": [[10, 25, 50, 100],[10, 25, 50, 100]], // Combobox Limit
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
                { "data": "total" ,
                   "name":"total"}, 
                { "data": "uang_dibayar" },  
                { "data": "sisa" },  
                { "data": "kode_penjualan",
                    render: function (data, type, row, meta) {
                        var beta="'"+data+"'";
                        return '<a onclick="viewDetail('+beta+')" class="btn btn-warning btn-xs" href="#" data-toggle="tooltip" title="Bayar"><i class="fas fa-eye"></i></i></a>';
                    }  
                },
            ],
        });
    });
    function viewDetail(id) {
        $('#modal-detail').modal('show');
        // alert(id);
        $('#form-detail').load("{{ url('Penjualan/detailTransaksi/')}}/" + id);
    }
</script>
@include('Foot')