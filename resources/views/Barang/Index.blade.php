@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-cube nav-icon"></i> Data Item</h1>

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
                                    <text class="text-white">Data Item</text>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive ">
                              
                                <a class="btn btn-info btn-sm" href="ItmCreate" <?=aktifbaru($butons['baru']);?>><i class="fas fa-plus"></i> Baru</a>
                                <!-- <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fas fa-file-excel"></i> Import</button> -->
                                <a class="btn btn-warning btn-sm" href="ExporBarang" ><i class="fas fa-file-excel"></i> Export</a>
                                        <br>
                                        <hr>
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NO. ITEM</th>
                                                <th>NAMA ITEM</th>
                                                <th>GROUP</th>
                                                <th>SATUAN</th>
                                                <th>STATUS</th>
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
<!-- awal modal -->
<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Import</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <form action="Test/ImportBarang" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="file">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                   
            </div>
            <div class="modal-footer justify-content-between">
              <a type="button" href="{{ url('export-data')}}" target="_blank" class="btn btn-warning" >Download Template (Excel)</a>
              <button type="submit" class="btn btn-primary">Import</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('Tag')

</div>
<!-- ./wrapper -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
@toastr_js
@toastr_render

<script>
    $(function () {
  bsCustomFileInput.init();
});
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
                "url": "/TableBarang", // URL file untuk proses select datanya
            },
            "deferRender": true,
            "aLengthMenu": [[ 25, 50, 100],[ 25, 50, 100]], // Combobox Limit
            "columns": [
                {"data": 'kode_barang',"sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                { "data": "no_barang" }, 
                { "data": "nama_barang" },  
                { "data": "kategori" },  
                { "data": "satuan" },
                { "data": "is_aktif" ,
                    "render": 
                    function( data, type, row, meta ) {
                        if(data=='Y'){
                          return '<span class="badge badge-success ">AKTIF</span>';  
                        }else{
                            return '<span class="badge badge-danger ">NON AKTIF</span>';  
                        }
                        
                    }},  
                { "data": "kode_barang",
                    "name": "kode_barang"},
            ],
        });
    });


</script>
@include('Foot')