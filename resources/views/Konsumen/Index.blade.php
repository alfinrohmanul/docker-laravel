@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fa fa-users nav-icon"></i> Data Konsumen</h1>

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
                                    <text class="text-white">Data Konsumen</text>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive ">
                                
                                <a class="btn btn-info btn-sm" href="CustCreate" <?=aktifbaru($butons['baru']);?>><i class="fas fa-plus"></i> Baru</a>
                                <a class="btn btn-warning btn-sm" href="Exkonsumen" ><i class="fas fa-file-excel"></i> Export</a>
                                        <br>
                                        <hr>
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NO. KONSUMEN</th>
                                                <th>NAMA KONSUMEN</th>
                                                <th>SEGMENTASI</th>
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
<!-- /.content-wrapper -->

@include('Tag')

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
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
$(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
                "url": "/TableCustomer", // URL file untuk proses select datanya
            },
            "deferRender": true,
            "aLengthMenu": [[25, 50, 100],[ 25, 50, 100]], // Combobox Limit
            "columns": [
                {"data": 'kode_konsumen',"sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                { "data": "no_konsumen" }, 
                { "data": "nama_konsumen" },  
                { "data": "segmentasi" }, 
                { "data": "no_hp" },  
                { "data": "kota" }, 
                { "data": "status_konsumen",
                "name":"status_konsumen" }, 
                { "data": "kode_konsumen",
                    render: function (data, type, row, meta) {
                        var beta="'"+data+"'";
                        var aktifvasiubah='<?=aktifubah($butons['ubah']);?>';
                        var aktifvasihapus='<?=aktifhapus($butons['hapus']);?>';
                        return '<a '+aktifvasiubah+' type="button" href="Custupdate/'+data+'" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a> <button type="button" onclick="trash('+ beta +')" class="btn btn-danger btn-xs" '+aktifvasihapus+'><i class="fas fa-trash-alt"></i></button>';
                    }  
                },
            ],
        });
    });

    $(document).on('change', 'input[name="status"]', function () {
            let id = $(this).attr('data-id');
            let val_state;

            if ($('#status_' + id).is(":checked")) {
                val_state = "Aktif";
            } else {
                val_state = "Non aktif";
            }

            $('.status_title_' + id).empty();

            var formData = {
                id: $(this).attr('data-id'),
                status: val_state
            }

            // console.log(formData);
            $.ajax({
                type: "post",
                url: "{{ URL::route('Konsumen.ubah_status') }}",
                data: formData,
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Status Konsumen berhasil diubah'
                    });

                    $('.status_title_' + response.id).append(response.title);
                }
            });
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
                url: "{{url('DestroyKonsumen')}}/"+id,
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