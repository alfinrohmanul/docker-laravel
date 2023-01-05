@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fab fa-dropbox nav-icon"></i> Ubah kategori</h1>

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
                        <div class="col-12 col-sm-6">
                            <div class="card card-primary card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Kategori</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Sub Kategori</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="col-sm-12 col-12">
                                        <input type="hidden" name="id" value="{{ $kategori->id }}">

                                            <div class="form-group">
                                                <label for="no_barang">Kategori</label>
                                                <input class="form-control form-control-sm" type="text" placeholder="kategori" autocomplete="off" name="kategori" onkeyup="this.value = this.value.toUpperCase()" value="{{$kategori->kategori}}">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                            <div class="col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label for="kode">Kode</label>
                                                    <input class="form-control form-control-sm" type="text" placeholder="kategori" autocomplete="off" name="kode" onkeyup="this.value = this.value.toUpperCase()">
                                                    <input class="form-control form-control-sm" type="text" value="{{ Request::segment(2) }}"  name="id_kategori" hidden>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_barang">Sub Kategori</label>
                                                    <input class="form-control form-control-sm" type="text" placeholder="kategori" autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" name="subkategori">
                                                </div>
                                                <button type="button" class="btn btn-block btn-primary btn-sm tambahsubs">Tambah</button>
                                            <hr>
                                            <div style="overflow-x: auto;">
                                        <table id="tabel_pendidikan" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th class="text-center">Kode</th>
                                                    <th class="text-center">Sub Kategori</th>
                                                    <th class="text-center">#</th>
                                                </tr>
                                            </thead>
                                            <tbody id="data_pendidikan">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                        </div>
                                        </div>
                                    </div>
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
@include('Tag')
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="{{ url('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<script>

$(document).ready(function(){
    pendidikan();
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var count = 0;
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
            $(".tambahsubs").click(function(){
                var formData = {
                    kode_sub: $('[name=kode]').val(),
                    nama_sub: $('[name=subkategori]').val(),
                    id_kategori: $('[name=id_kategori]').val()
                }
                    $.ajax({
                    url: "{{url('Subkategori/store')}}",
                    type: 'POST',
                    data: formData,
                    beforeSend: function() {
                        // $('.btn-pendidikan-spinner').removeClass('d-none');
                        // $('.btn-pendidikan-save').addClass('d-none');
                    },
                    success: function(response) {
                        $('#data_pendidikan').append(
				 '<tr class="records" id="row'+count+'">'
                    + '<td class="text-center">'+formData.kode_sub+'</td>'
                    + '<td class="text-center">'+formData.nama_sub+'</td>'
                    + '<td class="text-center"><button class="pendidikan_btn_delete border-0 bg-transparent text-danger" title="hapus" data-id="170"><i class="fa fa-trash"></i></button></td></tr>'
                    );

                        Toast.fire({
                            icon: 'success',
                            title: 'Sub Kategori berhasil diperbaharui'
                        });
                        // pendidikan();
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + error

                        Toast.fire({
                            icon: 'error',
                            title: 'Error - ' + errorMessage
                        });
                    }
                });

          

                });
});


        function pendidikan() {

            $.ajax({
                url:"{{url('GetSubkateg') }}/"+{{ Request::segment(2) }},
                type: 'GET',
                success: function(response) {
                    var pendidikan_data = "";
                    // console.log(response);
                    if (response.pendidikans.length == 0) {
                        pendidikan_data += "" +
                            "<tr>" +
                                "<td class=\"text-center\" colspan=\"3\">Kosong</td>";
                            "</tr>";
                    } else {
                        $.each(response.pendidikans, function(index, value) {
                            pendidikan_data += "" +
                            "<tr>" +
                                "<td class=\"text-center\">" + value.kode_sub + "</td>" +
                                "<td class=\"text-center\">" + value.nama_sub + "</td>" +
                                "<td class=\"text-center\">" +
                                    "<button class=\"pendidikan_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                                            "<i class=\"fa fa-trash\"></i>" +
                                    "</button>" +
                                "</td>" +
                            "</tr>";
                        });
                    }
                    $('#data_pendidikan').append(pendidikan_data);
                }
            });
        }
</script>
@include('Foot')