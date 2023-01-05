@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fa fa-check nav-icon"></i> Buat Akun</h1>

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
                                    <text class="text-white">Buat Baru</text>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                @if ($message = Session::get('succes'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                    </div>
                                @endif
                                <form action="SaveAkun" method="post">
                                    {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                    <input type="hidden" name="kode_akun" value="{{ $primary }}">
                                        <div class="form-group">
                                            <label for="no_barang">No Akun</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="No.Item" autocomplete="off" name="no_akun" value="{{$counter}}">
                                            @if($errors->has('no_akun'))
                                            <div class="text-danger">{{ $errors->first('no_akun') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="nabar">Nama Akun</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="Nama Akun..." autocomplete="off" name="nama_akun" value="{{old('nama_akun')}}">
                                            @if($errors->has('nama_akun'))
                                            <div class="text-danger">{{ $errors->first('nama_akun') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sabar">Keterangan</label>
                                            <textarea class="form-control" rows="2" placeholder="Katerangan ..." name="keterangan">{{old('keterangan')}}</textarea>
                                            @if($errors->has('keterangan'))
                                            <div class="text-danger">{{ $errors->first('keterangan') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="nabar">Tipe Akun</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="Kredit/Debet..." autocomplete="off" name="tipe" value="{{old('tipe')}}">
                                            @if($errors->has('tipe'))
                                            <div class="text-danger">{{ $errors->first('tipe') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sabar">Is Header</label>
                                            <select class="form-control form-control-sm" name="is_header">
                                                <option value="N">N</option>
                                                <option value="Y">Y</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Induk Akun:</label>
                                            <select class="form-control form-control-sm" id="input-grup" name="akuninduk">
                                                <?php
                                                $master=DB::select("select * from tb_akun where is_header='Y'");
                                                foreach($master as $makun){
                                                    ?>
                                                    <option value="<?=$makun->kode_akun?>"><?=$makun->nama_akun?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <div id="error"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sabar">Status Akun</label>
                                            <select class="form-control form-control-sm" name="status">
                                                <option value="Aktif">Aktif</option>
                                                <option value="Non Aktif">Non Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
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

<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="{{ url('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<script>

function trash(){
    alert('test');
}
</script>
@include('Foot')