@include('Head')
@include('Menu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-12">
                    <h1 class="m-0 text-dark">
                        <i class="fas fa-arrow-alt-circle-up"></i>
                        Form Permitaan Order
                    </h1>
                 
                            @if ($message = Session::get('succes'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                    </div>
                                @endif
                </div><!-- /.col -->

            </div>
        </div>

    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <form action="{{url('Permintaan/UpdateProses')}}" method="POST" id="form-barang">
            {{ csrf_field() }}
                <div class="row">
                <section class="col-lg-9 connectedSortable ui-sortable">

                            <!-- USERS LIST -->
                            <div class="card" name="jajalriset">
                            <div class="card-header ui-sortable-handle" style="cursor: move;">
                                <h3 class="m-0 card-title">
                                    Informasi Transaksi
                                </h3>
                                <div class="card-tools">
                                    <!--<span class="badge badge-danger">8 New Members</span>-->
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>

                                </div>

                            </div>
                           
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-4 col-12">
                                        <label class="col-form-label-sm">No PO</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" name="no_po" value="{{$master->no_po}}" readonly>
                                            <input type="text" class="form-control" name="kode_po" value="{{$master->kode_po}}" hidden>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label class="col-form-label-sm">Tanggal Kirim</label>
                                        <div class="input-group input-group-sm">
                                            <input type="date" class="form-control" name="tgl_po" id="tgl_po" value="{{$master->tgl_kirim}}">
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-4 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm">Cara Pengiriman</label>
                                            <select class='form-control form-control-sm' id='via' name='via'>
                                                @if($master->fob=='Dikirim')
                                                <option value="Dikirim" selected>Dikirim</option>
                                                @else
                                                <option value="Dikirim">Dikirim</option>
                                                @endif
                                                @if($master->fob=='Diambil')
                                                <option value="Diambil" selected>Diambil</option>
                                                @else
                                                <option value="Diambil">Diambil</option>
                                                @endif
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="form-group">
                                            <label>Catatan</label>
                                            <textarea class="form-control" rows="2" id="keterangan" name="keterangan" placeholder="Catatan ...">{{$master->keterangan}}</textarea>
                                        </div>  
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" rows="2" id="alamat" name="alamat" placeholder="Enter ...">{{$master->alamat_panjang}}</textarea>
                                        </div>  
                                    </div>
                                  
                                    <div class="col-lg-12 col-12">
                                        <input class="form-control" type="text" id="nomor" value="0" hidden>
                                        <div class="form-group" id="barang-parent">
                                            <label class="col-form-label-sm">Pilih Barang</label>
                                            <select class="form-control select2" name="barang" onchange="pilihBarang()">
                                                @foreach($barang as $brg)
                                               <option value="{{$brg->kode_barang}}">{{$brg->nama_barang}}</option>
                                               @endforeach
                                            </select>
                                            <div id="error"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col mt-3">
                                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                        <button type="button" class="btn btn-outline-secondary float-right mr-3" data-dismiss="modal"> Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!--/.card -->
                    <!-- card for daftar barang -->
                        <!-- USERS LIST -->
                        <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move;">

                                <h3 class="m-0 card-title">
                                    Data Barang
                                </h3>
                                <div class="card-tools">
                                    <!--<span class="badge badge-danger">8 New Members</span>-->
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="panel-body table-responsive p-0" style="height: 400px;">
                                    <table class="table table-bordered table-striped" id="formTable">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                                <th>Satuan</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbBarangList">
                                            <tr id="alertKosong">
                                                <td colspan="6" class="text-center"> - Belum ada barang ditambahkan -</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <!-- /.card-footer -->
                        </div>
                        <!--/.card -->
                        </form>
                    </section>
                    <section class="col-lg-3 connectedSortable ui-sortable">
                    <div class="card">
                        <div class="card-header ui-sortable-handle">
                            <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Informasi
                            </h3>

                        </div>

                        <div class="card-body">
                        <div class="alert alert-warning" role="alert">
                                                Silahkan lengkapi data pemesanan</i>
                                            </div>
                        </div>
                    </div>

                    </section>
                </div>
            
        </div>

        <!-- /.modal -->
        <div class="modal fade" id="modal-xl">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Daftar PO</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body table-responsive">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="example1" class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>No. PO</th>
                                                    <th>Cabang</th>
                                                    <th>Tanggal</th>
                                                    <th>Pembuat</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                        
                                            </tbody>
                                        </table>
                        </div>
                    </div>
                             
                </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- /.content -->
</div>

@include('Tag')

<!-- /.control-sidebar -->
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
$.widget.bridge('uibutton', $.ui.button)
$('.select2').select2({theme: 'bootstrap4'})
</script>

<script>
  var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;

    document.getElementById('tgl_po').value = today;
    DetailPo()
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

    function pilihBarang() {
        var id_barang = $('[name=barang]').val();
        var nomor = document.getElementById('nomor').value;
        var urutan = parseInt(nomor) + 1;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('Permintaan/addRowBarangKeluar')}}",
            method: "POST",
            data: {
                id_barang: id_barang,
                urutan: urutan
            },
            success: function(data) {
                $('#tbBarangList').append(data);
                $('#nomor').val(urutan);
                // document.getElementById('alertKosong').style.display = 'none';

            }
        });

        // alert(urutan);

    }

    function DetailPo(){
        var kode=$('[name=kode_po]').val();
        $.ajax({
        url: "{{url('DetailPO')}}/"+kode,
        type: 'GET',
        beforeSend: function(e) {
            // if (e && e.overrideMimeType) {
            //     e.overrideMimeType("application/json;charset=UTF-8");
            // }
        },
        success: function(response) {
          var podetailnya = "";
          $.each(response.detailpo, function(index, value) {
            podetailnya += '<tr><td style="width: 40%;"><input value="'+value.nama_barang+'" class="form-control  form-control-sm" type="text" id="nama" name="nama[]" autocomplete="off"  readonly><input value="'+value.kode_barang+ '"class="form-control  form-control-sm" type="text" id="id" name="kode_barang[]" autocomplete="off"  hidden><input value="'+value.no_barang+'"class="form-control  form-control-sm" type="text" id="no" name="no_barang[]" autocomplete="off"  hidden></td>'
            +'<td><input value="' +value.qty_pesan+ '" class="form-control form-control-sm text-center" type="text" id="qty" name="qty[]" autocomplete="off" value="1"></td>'
            +'<td><input value="' +value.satuan+ '" class="form-control  form-control-sm" name="satuan[]" type="text" readonly></td>'
            +'<td><input value="' +parseInt(value.harga)+ '" class="form-control  form-control-sm text-right hrg-sat" type="text" name="hrg_satuan[]" autocomplete="off" readonly></td>'
            +'<td><input value="' +parseInt(value.harga)*value.qty_pesan+ '" class="form-control  form-control-sm text-right"  type="text" name="hrg_total[]"  autocomplete="off" readonly></td>'
            +'<td><button class="btn btn-secondary btn-sm konfirmasi-hapus" data-toggle="tooltip" id="" title="Bayar" onclick="deleteRow(this)"><i class="fas fa-trash-alt"></i></i></button></td>'
            +'</tr>';
                        });
            $("#tbBarangList").html(podetailnya);

            // document.getElementById('alertKosong').style.display = 'none';
        },
        error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
            alert(xhr.status + "\n" + xhr.responseText + "\n" +
                thrownError); // Munculkan alert error
        }
    })
    }

    function deleteRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("formTable").deleteRow(i);
    }
</script>
</body>
</html>