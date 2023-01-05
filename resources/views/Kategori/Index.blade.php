@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fab fa-dropbox nav-icon"></i> Data Kategori</h1>

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
                        <div class="col-md-6">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header ui-sortable-handle" style="background-color:#15489B;">
                                    <text class="text-white">Data Kategori</text>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive ">
                                
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-success" <?=aktifbaru($butons['baru']);?>><i class="fas fa-plus"></i> Baru</button>
                                        <br>
                                        <hr>
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>KODE KATEGORI</th>
                                                <th>NAMA KATEGORI</th>
                                                <th>CABANG</th>
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
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-success">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <form id="form_create">
            <div class="modal-header">
            <h4 class="modal-title">Kategori Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="col-lg-12 col-12">
                    <div class="form-group">
                        <label for="nama_peserta">Kode Grup</label>
                        <input class="form-control form-control-sm" type="text" onkeyup="this.value = this.value.toUpperCase()" placeholder="Kode Grup" autocomplete="off" name="numberof">
                    </div>
                    <div class="form-group">
                        <label for="nomer_peserta">Kategori</label>
                        <input class="form-control form-control-sm" type="text" onkeyup="this.value = this.value.toUpperCase()" placeholder="Kategori" autocomplete="off" name="kategori">
                    </div>
                    <div class="form-group">
                        <label for="kategorifor">Kategori For</label>
                        <select name="kategorifor" class="form-control form-control-sm">
                            <option value="Adaya">Adaya</option>
                            <option value="Wahana">Wahana</option>
                            <option value="Abata">Abata</option>
                            <option value="Utak Atik">Utak Atik</option>
                            <option value="All">all</option>
                        </select>
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
@include('Tag')


<!-- /.control-sidebar -->
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
                "url": "/TableKategori", // URL file untuk proses select datanya
            },
            "deferRender": true,
            "aLengthMenu": [[10, 25, 50, 100],[10, 25, 50, 100]], // Combobox Limit
            "columns": [
                {"data": 'id',"sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                { "data": "numberof" }, 
                { "data": "kategori" }, 
                { "data": "kategorifor" }, 
                { "data": "id",
                    render: function (data, type, row, meta) {
                        var beta="'"+data+"'";
                        var aktifvasiubah='<?=aktifubah($butons['ubah']);?>';
                        var aktifvasihapus='<?=aktifhapus($butons['hapus']);?>';
                        return '<a '+aktifvasiubah+' type="button" href="KategoriUpdate/'+data+'" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a> <button type="button" onclick="trash('+ beta +')" class="btn btn-danger btn-xs" '+aktifvasihapus+'><i class="fas fa-trash-alt"></i></button>';
                    }  
                },
            ],
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
                url: "{{url('DestroyKategori')}}/"+id,
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

$('#form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                kategori: $('[name=kategori]').val(),
                numberof: $('[name=numberof]').val(),
                kategorifor: $('[name=kategorifor]').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: "{{url('SaveKategori')}}",
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
</script>
@include('Foot')