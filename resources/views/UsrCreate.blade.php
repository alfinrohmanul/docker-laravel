@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-user-cog nav-icon"></i> Buat Baru</h1>
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
                            <div class="card">
                                <div class="card-header ui-sortable-handle" style="background-color:#15489B;">
                                    <text class="text-white">Buat Baru</text>
                                </div>
                                <div class="card-body">
                                    <form action="createusermn" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group" id="id-karyawan-parent">
                                                <label class="col-form-label-sm" for="naker">Nama Karyawan</label>
                                                <select class='form-control form-control-sm' id='id-karyawan' name="nama_karyawan">
                                                    <option>Pilih Karyawan</option>

                                                </select>
                                            </div>
                                            <input type="hidden" name="namakry" >
                                            <div class="form-group">
                                            <label for="email">Email User</label>
                                                <input class="form-control form-control-sm" type="text" placeholder="Email" id="email" name="email" readonly >
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
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
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="assets/wis.js"></script>
<script>
// var tes:
$(function() {
    $("#example1").DataTable({
        "responsive": true,
    });

    $('#id-karyawan').select2({
    dropdownParent: $('#id-karyawan-parent')
});

$.ajax({
    url:'https://abata-printing.com/api/api/karyawan',
    dataType: 'json',
    success: function( json ) {
        $.each(json.data, function(i, value) {
            $('#id-karyawan').append($('<option>').text(value.nama_lengkap).attr('value', value.id));
        });
    }
});
});

$('#id-karyawan').change(function(){ 
        var value = $(this).val();
        Swal.fire('Loading');
        Swal.showLoading();
        $.ajax({
            url: "https://abata-printing.com/api/api/karyawan/"+value+"/show",
            dataType: 'json',
            success: function(json) {
                $('[name=email]').val(json.data.email);
                $('[name=namakry]').val(json.data.nama_lengkap);
                // $('[name=alamat]').val(data.alamat);
                swal.close()
                // console.log(data);
            }
        });
    });


    function validate(iduser,idmenu,idsub,acces) {
	Swal.fire('Sedang Proses')
	Swal.showLoading()
      $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                type : 'post',
                url : 'access',
				data :{
                    id: iduser,
                    idmenu:idmenu,
                    idsub:idsub,
                    aces:acces,
                },
                success : function(response){
					Swal.close();
                    // console.log(response);
				}
	});
} 
</script>
@include('Foot')