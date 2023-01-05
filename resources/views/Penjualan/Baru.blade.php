@include('Head')
@include('Menu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-cart-plus"></i> Input Penjualan</h1>
                </div><!-- /.col -->

            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="button" class="btn btn-primary mb-3" onclick="tampilModal()">
                                <i class="fas fa-plus"> </i> Tambah Produk atau Layanan
                            </button>
                        </div>
                    </div>


                    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:700px; ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Silahkan pilih Produk atau Layanan dibawah ini</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table id="xbarang" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Barang</th>
                                                        <th>Kategori</th>
                                                        <th>Harga</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                        </div>
                                        <div class="card-body">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
              
                    <div class="row">
                    <div class="col-lg-12">
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                            <div>
                            No. Transaksi : {{$no_transaksi->no_penjualan}}
                            </div>
                        </div>  
                </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Pelanggan</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    
                          
                                    <div class="row">
                                    <input type="text" class="form-control form-control-sm" name="kode_penjualan" value="{{$no_transaksi->kode_penjualan}}" hidden>
     
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="nama">Nama Konsumen</label>
                                                <input type="text" class="form-control form-control-sm" readonly name="nama_konsumen" value="{{$datakonsumen->nama_konsumen}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="nama">Nomor HP</label>
                                                <input type="text" class="form-control form-control-sm" readonly name="no_hp" value="{{$datakonsumen->no_hp}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="nama">Alamat</label>
                                                <textarea class="form-control" rows="3" readonly name="alamat" style="margin-top: 0px; margin-bottom: 0px; height: 100px;">{{$datakonsumen->alamat}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-lg-9 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Detail Pembelian</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-lg-12" id="cart_col">
                                                
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                <form action="{{ url('Penjualan/actionUbahDetailTransaksi/')}}/{{$no_transaksi->kode_penjualan}}" method="POST">
                                {{ csrf_field() }}
                                        <input type="text font-weight-bold" class="form-control" id="tr_total_harga" name="tr_total_harga" value="" hidden>

                                        <input type="submit" value="Proses Transaksi" class="ml-3 btn btn-success float-right">
                                        <a href="" class="btn btn-secondary float-right">Batal</a>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">WAHANA</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> <?php echo date('M'); ?>
    </div>
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ url('assets/plugins/toastr/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/jquery.price_format.min.js')}}"></script>
<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#cart_col').load("{{ url('Penjualan/TampilkanTransaksiDetail/')}}/{{$no_transaksi->kode_penjualan}}");
 var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    $(function() {
        $('#id-karyawan').select2({
    dropdownParent: $('#id-karyawan-parent')
});
    });
</script>

<script>
    // var keytransaksi='{{$no_transaksi->kode_penjualan}}';
    function tampilModal() {
        $('#modal-default').modal('show');
        tampilmenu();
    }
function tampilmenu(){
       var tabel = null;
    $(document).ready(function() {
        tabel = $('#xbarang').DataTable({
            "retrieve": true,
            // "paging": false,
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax":
            {
                "url": "/TableBarangjual", // URL file untuk proses select datanya
            },
            "deferRender": true,
            "aLengthMenu": [[10, 25, 50, 100],[10, 25, 50, 100]], // Combobox Limit
            "columns": [
                { "data": "nama_barang" }, 
                { "data": "kategori" }, 
                { "data": "harga",
                "name": "harga" },   
                { "data": "kode_barang",
                    render: function (data, type, row, meta) {
                        var beta="'"+data+"'";
                        return '<button type="button" onclick="tambahKeranjang('+beta+')" btn_add'+data+' name="btn_add" data-barangid="'+data+'" class="btn btn-success btn-xs"><i class="fas fa-fw fa-plus"></i></button>';
                    }  },
            ],
        });
    });
}
var count=0;
function tambahKeranjang(nmbr) {
        // var barang_id = $('.btn_add' + nmbr).data("barangid");
        // var no_transaksi = $('.btn_add' + nmbr).attr("barangnm");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('Penjualan/insertDetailTransaksi/')}}",
            data: {
                kode_penjualan : $('[name=kode_penjualan]').val(),
                id_barang : nmbr,
            },
            success: function(data) {
                Toast.fire({
                    icon: 'success',
                    title: 'Barang ditambahkan'
                })
                loadKeranjang();
                totalharga();
                console.log(data);
            }
        });
    }
    function hapusKeranjang(nmbr) {
        var det_id = $('.btn_del' + nmbr).data("detid");
        var det_nama = $('.btn_del' + nmbr).data("detnama")
        
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        if (confirm("Yakin akan menghapus " + det_nama + " dari keranjang ?")) {
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                url: "{{ url('Penjualan/hapusDetailTransaksi/')}}/{{$no_transaksi->kode_penjualan}}",
                method: "POST",
                data: {
                    det_id: det_id,
                },
                success: function(data) {
                    // alert(det_nama + " Dihapus Dari Keranjang ");
                    loadKeranjang();
                    totalharga();
                    Toast.fire({
                        icon: 'warning',
                        title: det_nama + ' Dihapus dari keranjang'
                    })
                   
                }
            });
        } else {
            return false;
        }
     
    }
    function loadKeranjang() {
        $('#cart_col').load("{{ url('Penjualan/TampilkanTransaksiDetail/')}}/{{$no_transaksi->kode_penjualan}}");

    }
    function updateNama(urutan) {
        var $rows = $('#row' + urutan);
        var $nama_file = ($rows).find('#dtr_nama').val();
        var $dtr_id = parseInt($($rows).find('#dtr_id').val());


        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        // alert('halo' + $nama_file);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('Penjualan/updateNamaFileKeranjang/')}}/"+$dtr_id,
            method: "POST",
            data: {
                dtr_id: $dtr_id,
                dtr_nama: $nama_file,
            },
            success: function(data) {

                Toast.fire({
                    icon: 'success',
                    title: 'Nama File Berhasil Diubah'
                })

                $($rows).find('#dtr_nama').val(data);
                // console.log(data);
            }
        });

    }

    function sum(urutan) {
        var $rows = $('#row' + urutan);
        // alert('Hore berhasill');
        var $dtr_id = parseInt($($rows).find('#dtr_id').val());
        var $panjang = parseInt($($rows).find('#dtr_panjang').val());
        var $lebar = parseInt($($rows).find('#dtr_lebar').val());
        var $jumlah = parseInt($($rows).find('#dtr_jumlah').val());
        var $harga = ($rows).find('#dtr_harga').val();
        var $hpp = ($rows).find('#hpp_total').val();
        var $satuan = ($rows).find('#dtr_satuan').val();

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('Penjualan/updatedatacart/')}}/"+$dtr_id,
            method: "POST",
            data: {
                dtr_id:$dtr_id,
                dtr_panjang: $panjang,
                dtr_lebar: $lebar,
                dtr_jumlah: $jumlah,
                dtr_harga: $harga,
                hpp_total:$hpp
            },
            success: function(data) {
                var $harjul = data;
                // alert($harjul);

                if ($satuan == 'Y') {
                    var $subtot = $harjul;
                } else {
                    var $subtot = $panjang * $lebar * $jumlah * $harjul / 10000;
                }
                // alert($harjul);
                if (!isNaN($subtot)) {
                    // $($rows).find('#vdtr_harga').html($harjul);
                    $($rows).find('#vdtr_total').html($subtot);
                    $($rows).find('#vdtr_total').priceFormat({
                        prefix: '',
                        centsLimit: 0,
                        thousandsSeparator: '.',
                    });

                    $($rows).find('#dtr_harga').val($harjul);
                    $($rows).find('#dtr_total').val($subtot);
                    $($rows).find('#hpp_total').val($hpp);
                    $($rows).find('#dtr_harga').priceFormat({
                        prefix: '',
                        centsLimit: 0,
                        thousandsSeparator: '.',
                    });
                    $($rows).find('#hpp_total').priceFormat({
                        prefix: '',
                        centsLimit: 0,
                        thousandsSeparator: '.',
                    });
                    // var total=$subtot;  	
                    totalharga();
                } else {
                    // $($rows).find('#vdtr_harga').html($harjul);
                    $($rows).find('#vdtr_total').html($subtot);
                    $($rows).find('#vdtr_total').priceFormat({
                        prefix: '',
                        centsLimit: 0,
                        thousandsSeparator: '.',
                    });

                    $($rows).find('#dtr_harga').val($harjul);
                    $($rows).find('#hpp_total').val($harjul);
                    $($rows).find('#dtr_total').val($subtot);
                    $($rows).find('#dtr_harga').priceFormat({
                        prefix: '',
                        centsLimit: 0,
                        thousandsSeparator: '.',
                    });
                    //var total='0';  	
                    totalharga();
                }

                Toast.fire({
                    icon: 'success',
                    title: 'Pengubahan Data Berhasil'
                })
            }
        });
    };

    function totalharga() {
        var sum = 0;
        var ct = 0;
        $(".records").each(function() {
            var $jumlah = $(this).find('#dtr_total').val();
            sum += parseInt($jumlah);
        });

        var number_string = sum.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        $("#display_total").html(rupiah);
        $('#tr_total_harga').val(sum);
        // $('#hoho').val(sum);
    };
</script>
@include('Foot')