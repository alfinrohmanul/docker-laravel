@include('Head')
@include('Menu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-shopping-cart nav-icon"></i> Permintaan Order</h1>

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
                                <a class="btn btn-info btn-sm" href="OrderanBaru" <?=aktifbaru($butons['baru']);?>><i class="fas fa-plus"></i> Baru</a>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive "> 
                                <div class="form-group row">
                                        <div class="col-lg-2 col-12">
                                            <!-- <label for="tgl_awal">Tanggal</label> -->
                                            <input class="form-control form-control-sm" type="date" id="tgl_awal">
                                        </div>
                                        <div class="col-lg-2 col-12">
                                            <!-- <label for="tgl_akir">Tanggal</label> -->
                                            <input class="form-control form-control-sm" type="date" id="tgl_akir">
                                        </div>
                                        <div class="col-lg-2 col-12">
                                        <!-- <label for="tgl_akir">Tanggal</label> -->
                                            <button type="button" class="btn btn-block btn-success btn-sm"><i class="fas fa-filter"></i> Filter</button>
                                            </div>
                                    </div>
                                        <hr>
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NO PO</th>
                                                <th>TANGGAL</th>
                                                <th>CUSTOMER</th>
                                                <th>TGL.KIRIM</th>
                                                <th>PENGIRIMAN</th>
                                                <th>STATUS DOK</th>
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
        <div class="modal fade" id="modal-print">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Transaksi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('Tag')

<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
@toastr_js
@toastr_render
<script>
     var tabel = null;
     var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;


    document.getElementById('tgl_awal').value = today;
    document.getElementById('tgl_akir').value = today;

    
    $(document).ready(function() {
        tabel = $('#example1').DataTable({
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax":
            {
                "url": "{{url('Permintaan/GetPO')}}", // URL file untuk proses select datanya
            },
            "deferRender": true,
            "aLengthMenu": [[ 25, 50, 100],[ 25, 50, 100]], // Combobox Limit
            "columns": [
                {"data": 'kode_po',"sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                { "data": "no_po" }, 
                { "data": "tgl_po" },  
                { "data": "nama_cabang" },
                { "data": "tgl_kirim"},
                { "data": "fob"},
                { "data": "status"},
                { "data": "kode_po" ,
                    render: function (data, type, row, meta) {
                        var beta="'"+data+"'";
                        var bas='';
                        if(row.status=="Terbuka"){
                            bas=' <a type="button" href="Po/'+data+'/Edit" class="btn btn-success btn-xs"><i class="fas fa-edit"></i></i></a>';
                        }
                        return '<button type="button" onclick="viewDetail('+beta+')" class="btn btn-warning btn-xs"><i class="fas fa-print"></i></i></button>'+bas;
                    }  
                    },
            ],
        });
    });
</script>
@include('Foot')