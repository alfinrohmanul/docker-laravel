@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-user-cog nav-icon"></i> Data Pengguna</h1>
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
                                    <text class="text-white">Data Pengguna</text>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive ">
                                    <!-- <div class="callout callout-warning">
                                        <h5>Rule</h5>
                                        (0) Superadmin</br>
                                        (1) Admin</br>
                                        (2) Gudang</br>
                                        (3) Kasir</br>
                                        (4) Finance</br>
                                        (5) Accounting</p>
                                    </div> -->
                                    <a class="btn btn-info btn-sm" href="UsrCreate"><i class="fas fa-plus"></i> Baru</a>
                                        <br>
                                        <hr>
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>USER ID</th>
                                                <th>EMAIL</th>
                                                <th>STATUS</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                      <tbody>
                                       @foreach($user as $u=>$getdata)
                                       <tr>
                                           <td>{{$u+1}}</td>
                                           <td>{{$getdata->name}}</td>
                                           <td>{{$getdata->email}}</td>
                                           <td><div id="var{{$getdata->id}}"><span class="badge badge-success ">{{$getdata->status}}</span></div></td>
                                           <td>
                                           <a type="button" class="btn btn-primary btn-xs" href="privilage/{{$getdata->id}}"><i class="fas fa-key"></i></a>
                                               <a type="button" class="btn btn-warning btn-xs" href="EditPengguna"><i class="fa fa-edit"></i></a> 
                                           <a type="button" class="btn btn-success btn-xs" href="ResetPengguna"><i class="fas fa-history"></i></a>
                                           <button type="button" class="btn btn-danger btn-xs" onclick="nonaktifkan({{$getdata->id}})"><i class="fas fa-power-off"></i></button>
                                        </td>
                                       </tr>
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
<script type="text/javascript" src="assets/jquery.price_format.min.js"></script>

<script>
// var tes:
$(function() {
    $("#example1").DataTable({
        "responsive": true,
    });
});

function nonaktifkan(key){
    // alert('nonaktifkan');
    document.getElementById("var"+key).innerHTML="<span class='badge badge-danger'>Non Aktif</span>";
}

</script>
@include('Foot')