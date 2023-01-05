@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-user-tie nav-icon"></i> Ubah Supplier</h1>

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
                                    <text class="text-white">Ubah Data</text>

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
                                @foreach($supp as $s)
                                <form action="{{url('UpdateSupp')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                    <input type="hidden" name="id" value="{{ $s->kode_supp }}">
                                        <div class="form-group">
                                            <label for="no_barang">No Supplier</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="No.Item" autocomplete="off" name="no_supp" value="{{$s->no_supp}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nabar">Nama Supplier</label>
                                            <input class="form-control form-control-sm" type="text" autocomplete="off" name="nama_supp" value="{{$s->nama_supp}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="sabar">No Telp</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="No Telp..." autocomplete="off" name="no_telp" value="{{$s->no_telp}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="sabar">Kota</label>
                                            <input class="form-control form-control-sm" type="text" placeholder="Kota..." autocomplete="off" name="kota" value="{{$s->kota}}">
                                            @if($errors->has('kota'))
                                            <div class="text-danger">{{ $errors->first('kota') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sabar">Alamat</label>
                                            <textarea class="form-control" rows="3" placeholder="Alamat ..." name="alamat">{{$s->alamat}}</textarea>
                                            @if($errors->has('alamat'))
                                            <div class="text-danger">{{ $errors->first('alamat') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sabar">Status Supplier</label>
                                            <select class="form-control form-control-sm" name="status">
                                                <option value="Aktif">Aktif</option>
                                                <option value="NonAktif">Non Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                            @endforeach
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