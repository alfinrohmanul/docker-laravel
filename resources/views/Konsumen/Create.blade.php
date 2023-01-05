@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-user-tie nav-icon"></i> Buat Konsumen</h1>

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
                                <form action="SaveKonsumen" method="post">
                                    {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="no_barang">No Konsumen</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="No.Item" autocomplete="off" name="no_konsumen" value="{{$counter}}" readonly>
                                            @if($errors->has('no_konsumen'))
                                            <div class="text-danger">{{ $errors->first('no_konsumen') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="nabar">Nama Konsumen</label>
                                            <input class="form-control form-control-sm" onkeyup="this.value = this.value.toUpperCase()" type="text" placeholder="Nama Konsumen..." autocomplete="off" name="nama_konsumen" value="{{old('nama_konsumen')}}">
                                            @if($errors->has('nama_konsumen'))
                                            <div class="text-danger">{{ $errors->first('nama_konsumen') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sabar">No Telp</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="No Telp..." autocomplete="off" name="no_hp" value="{{old('no_hp')}}">
                                            @if($errors->has('no_hp'))
                                            <div class="text-danger">{{ $errors->first('no_hp') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sabar">Kota</label>
                                            <input class="form-control form-control-sm" type="text" onkeyup="this.value = this.value.toUpperCase()" placeholder="Kota..." autocomplete="off" name="kota" value="{{old('kota')}}">
                                            @if($errors->has('kota'))
                                            <div class="text-danger">{{ $errors->first('kota') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sabar">Alamat</label>
                                            <textarea class="form-control" rows="3" placeholder="Alamat ..." onkeyup="this.value = this.value.toUpperCase()" name="alamat">{{old('alamat')}}</textarea>
                                            @if($errors->has('alamat'))
                                            <div class="text-danger">{{ $errors->first('alamat') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sabar">Segmentasi</label>
                                            <select class="form-control form-control-sm" name="segmentasi">
                                                <option value="Retail">Retail</option>
                                                <option value="Reseller">Reseller</option>
                                                <option value="Instansi">Instansi</option>
                                                <option value="Cabang">Cabang</option>
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
@include('Tag')

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

<script>

function trash(){
    alert('test');
}
</script>
@include('Foot')