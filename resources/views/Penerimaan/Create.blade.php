@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fa fa-sign-in-alt nav-icon"></i> Penerimaan Barang</h1>

                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <form action="Penerimaan/Simpanpenerimaan" method="POST" id="form-barang">
        {{ csrf_field() }}
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- /.card -->
                    <div class="row">
                        <div class="col-lg-9 col-12">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header ui-sortable-handle" style="background-color:#15489B;">
                                    <text class="text-white">Buat Baru</text>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" >Nomor Dokumen</label>
                                                <input value="{{$counter}}" type="text" class="form-control form-control-sm diskon" name="no_penerimaan" placeholder="contoh SJ12345" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" >Nomor SJ/FT</label>
                                                <input type="text" class="form-control form-control-sm" id="no_sj" name="no_sj" autocomplete="off" placeholder="contoh SJ12345">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" >Nama Supplier</label>
                                                <select class="form-control form-control-sm select2" name="nama_supp">
                                                    @foreach($supp as $sp)
                                                    <option value="{{$sp->kode_supp}}">{{$sp->nama_supp}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" >Tanggal SJ/FT</label>
                                                <input type="date" class="form-control form-control-sm" id="tglsj" name="tglsj" >
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" >Keterangan</label>
                                                <textarea class="form-control" rows="2" placeholder="Keterangan"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                        
                                        <div class="col-lg-12">
                                            <input class="form-control" type="text" id="nomor" value="0" hidden>
                                        <div class="form-group" id="barang-parent">
                                            <label class="col-form-label-sm">Pilih Barang</label>
                                            <select class="form-control form-control-sm select2" id='barang' name='barang' onchange="pilihBarang()">
                                            @foreach($barang as $brg)
                                                <option value="{{$brg->kode_barang}}">{{$brg->nama_barang}}</option>
                                                @endforeach
                                            </select>
                                            <div id="error"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-9 col-12">
                    <div class="card">
                        <div class="card-header ui-sortable-handle" style="background-color:#15489B;">
                             <text class="text-white">Daftar Barang</text>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <div class="panel-body table-responsive p-0" style="max-height: 400px;">
                                <table class="table table-bordered table-striped table-sm" id="formTable">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbBarangList">
                                        <tr id="alertKosong">
                                            <td colspan="6" class="text-center font-italic"> - Belum ada barang ditambahkan -
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="row">
                                <div class="col mt-3">
                                    <button type="submit" class="btn btn-primary float-right"
                                        id="konfirmasi">Konfirmasi</button>
                                    <button type="button" class="btn btn-outline-secondary float-right mr-3"
                                        data-dismiss="modal"> Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                    <!-- /.row -->
                    <!-- /.card -->
</form>
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


</div>
<!-- ./wrapper -->
<script src="{{ url('assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ url('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/jquery.price_format.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ url('assets/dist/js/adminlte.js')}}"></script>
<script>
$('.select2').select2({theme: 'bootstrap4'})
</script>
<script>

   

    $(window).ready(function() {
        $("#form-barang").on("keypress", function(event) {
            console.log("aaya");
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });
    });

// $.ajax({
//     url:'GetBarang',
//     dataType: 'json',
//     success: function( json ) {
//         $.each(json.data, function(i, value) {
//             $('#barang').append($('<option>').text(value.nama_barang).attr('value', value.kode_barang));
//         });
//     }
// });

function pilihBarang(){
    var id_barang = document.getElementById('barang').value;
        var nomor = document.getElementById('nomor').value;
        var urutan = parseInt(nomor) + 1;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "Penerimaan/addRowBarangMasuk",
            method: "POST",
            data: {
                id_barang: id_barang,
                urutan: urutan
            },
            success: function(data) {
                $('#tbBarangList').append(data);
                $('#nomor').val(urutan);
                document.getElementById('alertKosong').style.display = 'none';

            }
        });

        // alert(id_barang);
}

function sum(urutan) {
        var $rows = $('#row' + urutan);

        var $qty = parseInt($($rows).find('#qty_masuk').val());
        var $hrg_satuan = ($($rows).find('#vhrg_satuan').val());

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "Penerimaan/convertHargaSatuan/",
            method: "POST",
            data: {
                hrg_satuan: $hrg_satuan
            },
            success: function(data) {
                var $fix_hrg_satuan = data;
                var $hrg_total = $qty * $fix_hrg_satuan;
                // alert($qty + $hrg_satuan);
                $($rows).find('#vhrg_total').val($hrg_total);
                $($rows).find('#vhrg_total').priceFormat({
                    prefix: '',
                    centsLimit: 0,
                    thousandsSeparator: '.',
                });

                $($rows).find('#hrg_satuan').val($fix_hrg_satuan);
                $($rows).find('#hrg_total').val($hrg_total);

                // alert($fix_hrg_satuan);

            }
        });
}
function deleteRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("formTable").deleteRow(i);
    }
</script>
