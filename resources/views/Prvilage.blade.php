@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-user-cog nav-icon"></i> Privilege</h1>
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
                            <div class="card">
                                <div class="card-header ui-sortable-handle" style="background-color:#15489B;">
                                    <text class="text-white">Setting</text>
                                </div>
                                <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Menu</th>
                      <th>Tampil</th>
                      <th>Baru</th>
                      <th>Ubah</th>
                      <th>Hapus</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no=1;
                      $id_user=$keyindex;
                      $menuakses=DB::select("SELECT id_user,id_menu,id_sub,nama_menu,nama_sub,tampil,buat,ubah,hapus FROM tb_access_menu a
                      LEFT OUTER JOIN tb_menu b ON a.`id_menu`=b.`id`
                      LEFT OUTER JOIN tb_sub_menu c ON a.`id_sub_menu`=c.`id_sub`
                      WHERE id_user=$id_user");

                      foreach($menuakses as $menu){
                        $ac=$menu->id_sub;
                        $bb="'".$menu->id_user."','".$menu->id_menu."','".$menu->id_sub."','buat'";
                        $cc="'".$menu->id_user."','".$menu->id_menu."','".$menu->id_sub."','ubah'";
                        $dd="'".$menu->id_user."','".$menu->id_menu."','".$menu->id_sub."','hapus'";
                        $ee="'".$menu->id_user."','".$menu->id_menu."','".$menu->id_sub."','tampil'";
                        $baru='';
                        $edit='';
                        $hapus='';
                        $tampil='';
                        if($menu->buat=='Y'){
                            $baru='checked';
                        }
                        if($menu->ubah=='Y'){
                            $edit='checked';
                        }
                        if($menu->hapus=='Y'){
                            $hapus='checked';
                        }
                        if($menu->tampil=='Y'){
                            $tampil='checked';
                        }
                     ?>
                    <tr>
                        <td><?=$menu->nama_sub?></td>
                        <td><input id="num<?=$no++?>" name="s2" onclick="validate(<?=$ee?>)" type="checkbox" <?=$tampil?>></td>
                        <td><input id="num<?=$no++?>" name="s2" onclick="validate(<?=$bb?>)" type="checkbox" <?=$baru?>></td>
                        <td><input id="num<?=$no++?>" name="s2" onclick="validate(<?=$cc?>)" type="checkbox" <?=$edit?>></td>
					    <td><input id="num<?=$no++?>" name="s2" onclick="validate(<?=$dd?>)" type="checkbox" <?=$hapus?>></td>
                    </tr>
                    <?php 
                       }
                       ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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
<script src="{{ url('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
// var tes:
$(function() {
    $("#example1").DataTable({
        "responsive": true,
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
                url : "{{ url('access')}}",
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