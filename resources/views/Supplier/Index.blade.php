@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-user-tie nav-icon"></i> Data Supplier</h1>

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
                                    <text class="text-white">Data Supplier</text>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive ">
                                
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-supp" <?=aktifbaru($butons['baru']);?>><i class="fas fa-plus"></i> Baru</button>
                                <a class="btn btn-warning btn-sm" href="exportSupp" ><i class="fas fa-file-excel"></i> Export</a>
                                        <br>
                                        <hr>
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NO. SUPPLIER</th>
                                                <th>NAMA SUPPLIER</th>
                                                <th>TELP</th>
                                                <th>KOTA</th>
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

    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="modal-supp" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <form id="form_create">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Suplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="nama_peserta">Nama Suplier</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="Nama Suplier" autocomplete="off" name="nama_supp">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_peserta">No Telp</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="(0821) xxxxxx" autocomplete="off" name="no_hp">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_peserta">Kota</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="Kota" autocomplete="off" name="kotas">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_peserta">Alamat</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="Alamat" autocomplete="off" name="alamats">
                                        </div>
                                    </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-primary btn-create-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary btn-create-save" style="width: 130px;"><i class="fa fa-save"></i> Simpan</button>
                </div>
                </form>
        </div>

    </div>

</div>
<div class="modal fade" id="modal-edit" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <form id="form_edit">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Peseta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-12">
                <div class="form-group">
                                            <label for="edit_no_supp">No Suplier</label>
                                            <input class="form-control form-control-sm" type="text" readonly name="edit_no_supp">
                                        </div>
                <div class="form-group">
                                            <label for="nama_peserta">Nama Suplier</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="Nama Suplier" autocomplete="off" name="edit_nama_supp">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_peserta">No Telp</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="(0821) xxxxxx" autocomplete="off" name="edit_no_hp">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_peserta">Kota</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="Kota" autocomplete="off" name="edit_kotas">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_peserta">Alamat</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="Alamat" autocomplete="off" name="edit_alamats">
                                        </div>
                                    </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-primary btn-edit-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary btn-edit-save" style="width: 130px;"><i class="fa fa-save"></i> Perbaharui</button>
                </div>
                </form>
        </div>

    </div>

</div>
<!-- /.content-wrapper -->
@include('Tag')

</div>
<!-- ./wrapper -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script>

var tabel = null;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

    $(document).ready(function() {
        tabel = $('#example1').DataTable({
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax":
            {
                "url": "/TableSupp", // URL file untuk proses select datanya
            },
            "deferRender": true,
            "aLengthMenu": [[10, 25, 50, 100],[10, 25, 50, 100]], // Combobox Limit
            "columns": [
                {"data": 'kode_supp',"sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                { "data": "no_supp" }, 
                { "data": "nama_supp" },  
                { "data": "no_telp" },  
                { "data": "kota" },
                { "data": "status" ,
                    "render": 
                    function( data, type, row, meta ) {
                        if(data=='Aktif'){
                          return '<span class="badge badge-success ">'+data+'</span>';  
                        }else{
                            return '<span class="badge badge-danger ">'+data+'</span>';  
                        }
                    }},  
                { "data": "kode_supp",
                   "name":"kode_supp"
                },
            ],
        });
    });

    $('#form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                nama_supp: $('[name=nama_supp]').val(),
                no_hp: $('[name=no_hp]').val(),
                kota: $('[name=kotas]').val(),
                alamat: $('[name=alamats]').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: "{{url('SimpanSupp')}}",
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.btn-create-spinner').css("display", "block");
                    $('.btn-create-save').css("display", "none");
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil disimpan.'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        $('body').on('click', '.btn-edits', function(e) {
            e.preventDefault();

            var id = $(this).attr('data-id');
            var url = "{{url('SuppUpdate/:id/Edit')}}";
            url = url.replace(':id', id );

            var formData = {
                id: id,
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function(response) {
                    $('[name=edit_nama_supp]').val(response.nama_supp);
                    $('[name=edit_no_hp]').val(response.no_telp);
                    $('[name=edit_kotas]').val(response.kota);
                    $('[name=edit_alamats]').val(response.alamat);
                    $('[name=edit_no_supp]').val(response.no_supp);

                    $('.modal-edit').modal('show');
                }
            })
        });

        $('#form_edit').submit(function(e) {
            e.preventDefault();


            var formEdit = {
                no_supp: $('[name=edit_no_supp]').val(),
                nama_supp: $('[name=edit_nama_supp]').val(),
                no_hp: $('[name=edit_no_hp]').val(),
                kota: $('[name=edit_kotas]').val(),
                alamat: $('[name=edit_alamats]').val(),
                _token: CSRF_TOKEN
            }

            var id = 1;
            var url = "{{url('UpdateSupp/:id/Update')}}";
            url = url.replace(':id', id );

            $.ajax({
                url: url,
                type: 'PUT',
                data: formEdit,
                beforeSend: function() {
                    $('.btn-edit-spinner').css("display", "block");
                    $('.btn-edit-save').css("display", "none");
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil diperbaharui.'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }

                
            });
        });
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
    
    var formData = {
                id: id,
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: "{{url('destroysupp')}}/"+id,
                type: 'get',
                data: formData,
                success: function(response) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                }
            });
  }
})
}
</script>
@include('Foot')