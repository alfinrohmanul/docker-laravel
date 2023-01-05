@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-cube nav-icon"></i> Buat Item</h1>

                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <form action="{{url('SaveItmCreate')}}" method="POST" id="form-barang">
        {{ csrf_field() }}
            <!-- Main row -->
            <div class="row">
                <!-- Live -->
                <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Spesifikasi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-harga-tab" data-toggle="pill" href="#custom-tabs-one-harga" role="tab" aria-controls="custom-tabs-one-harga" aria-selected="true">Setting Harga</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-satuan-tab" data-toggle="pill" href="#custom-tabs-one-satuan" role="tab" aria-controls="custom-tabs-one-satuan" aria-selected="false">Satuan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-paket" role="tab" aria-controls="custom-tabs-one-paket" aria-selected="false">Paket</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-akun" role="tab" aria-controls="custom-tabs-one-akun" aria-selected="false">Akun</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <div class="card card-danger card-outline">
                            <div class="card-body">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="nabar">Nama Barang</label>
                                                <input class="form-control form-control-sm" onkeyup="this.value = this.value.toUpperCase()" type="text" placeholder="Nama Barang" autocomplete="off" name="nama_barang" value="{{old('nama_barang')}}">
                                                @if($errors->has('nama_barang'))
                                                <div class="text-danger">{{ $errors->first('nama_barang') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                <label for="groping">Group</label>
                                                <select class="form-control form-control-sm select2" name="grouping" id="groping">
                                                  @foreach($group as $grp)
                                                  <option value="{{$grp->numberof}}" dumpy="{{$grp->id}}">{{$grp->kategori}}</option>
                                                  @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                            <label>Sub</label>
                                            <select class="form-control select2 subgrup" style="width: 100%;" name="subkateg">
                                         
                                            
                                            </select>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-12">
                                              <div class="form-group">
                                                <label>Cabang</label>
                                                <select class="form-control form-control-sm" name="fors">
                                                  <option value="Adaya">Adaya</option>
                                                  <option value="Wahana">Wahana</option>
                                                  <option value="Abata">Abata</option>
                                                  <option value="Utak Atik">Utak Atik</option>
                                                  <option value="All">all</option>
                                                </select>
                                              </div>
                                              <div class="form-group">
                                                  <label for="nabar">Barcode Barang</label>
                                                  <input class="form-control form-control-sm" type="text" placeholder="Barcode" autocomplete="off" name="barcode">
                                              </div>
                                            </div>
                    </div>
                  </div>
</div>
                  <div class="tab-pane fade" id="custom-tabs-one-harga" role="tabpanel" aria-labelledby="custom-tabs-one-harga-tab">
                    <div class="card card-danger card-outline">
                            <div class="card-body">
                              <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="nabar">Hpp Barang</label>
                                                <input class="form-control form-control-sm text-right nominal" type="text" autocomplete="off" name="hpp_barang">
                                            </div>
                                            <div class="form-group">
                                                <label for="margin">Margin %</label>
                                                <input class="form-control form-control-sm text-right" type="text" autocomplete="off" name="marginset">
                                            </div>
                              </div>
                            </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-satuan" role="tabpanel" aria-labelledby="custom-tabs-one-satuan-tab">
                    <div class="card card-danger card-outline">
                          <div class="card-body">
                              <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="no_barang">Satuan 1</label>
                                                <input class="form-control form-control-sm" type="text" placeholder="Satuan 1" autocomplete="off" name="satuan1">
                                           
                                            </div>
                                            <div class="form-group">
                                                <label for="nabar">Satuan 2</label>
                                                <input class="form-control form-control-sm" type="text" placeholder="Satuan 2" autocomplete="off" name="satuan2">
                                                
                                            </div>
                              </div>
                            </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-paket" role="tabpanel" aria-labelledby="custom-tabs-one-paket-tab">
                    <div class="card card-danger card-outline">
                      <div class="col-sm-6">
                        <div class="form-group">
                        <select class="selectpicker form-control show-menu-arrow" data-live-search="true" data-style="btn-success" title="Cari Nama Barang...">
                          @foreach($barang as $bad)
                          <option>{{$bad->nama_barang}}</option>
                          @endforeach
                        </select>
                        </div>
                      </div>
                      <div class="card-body table-responsive p-0" style="height: 300px;">
                      <table class="table table-head-fixed text-nowrap">
<thead>
<tr>
<th>No Barang</th>
<th>Nama Barang</th>
<th>Satuan</th>
<th>Harga</th>
</tr>
</thead>
<tbody>
<tr>
<td>183</td>
<td>John Doe</td>
<td>11-7-2014</td>
<td><span class="tag tag-success">Approved</span></td>
</tr>

</tbody>
</table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade " id="custom-tabs-one-akun" role="tabpanel" aria-labelledby="custom-tabs-one-akun-tab">
                  <div class="card card-danger card-outline">
                          <div class="card-body">
                          <div class="col-sm-6">
                                                <div class="form-group">
                                                <label for="groping">Akun Penjualan</label>
                                                <select class="selectpicker form-control show-menu-arrow" data-live-search="true" name="kode_akun1" data-style="btn-success">
                                                @foreach($akun as $k)
                                                <?php 
                                                    if($k->is_header=="Y"){
                                                        $var="disabled";
                                                        $dump=$k->nama_akun;
                                                    }else{
                                                        $var="";
                                                        $dump="-- ".$k->nama_akun;
                                                    }
                                                    ?>
                                    <option <?=$var?> value="{{$k->kode_akun}}"><?=$dump?></option>
                                                @endforeach
<!-- 4750 -->
                                                </select>
                                                </div>
                                            </div>
<div class="col-lg-6 col-12" >
                                  <div class="form-group" id="groupakun">
                                    <label>Akun Hpp</label>
                                    <select class="form-control form-control-sm" style="width: 100%;" id="akun2" name="kodeakun2">
                                    @foreach($akun as $k)
                                          <?php 
                                                    if($k->is_header=="Y"){
                                                        $var="disabled";
                                                        $dump=$k->nama_akun;
                                                    }else{
                                                        $var="";
                                                        $dump="-- ".$k->nama_akun;
                                                    }
                                                    ?>
                                    <option <?=$var?> value="{{$k->kode_akun}}"><?=$dump?></option>
                                    @endforeach
                                    </select>
                                  </div>
                                </div>
                            </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
              </div>
              </form>
            </div>
          </div>
               <!-- styelws -->
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

<!-- jQuery UI 1.11.4 -->
<script src="{{ url('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ url('assets/dist/js/adminlte.js')}}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script>
  $('.select2').select2({theme: 'bootstrap4'})
 
  $("[name=grouping]").on('change', function() {
    // $("[name=subkategori]").hide();
    var kode = $(this).find('option:selected').attr('dumpy');
    $.ajax({
        url: "{{url('GetSubkateg')}}/"+kode,
        type: 'GET',
        beforeSend: function(e) {
            // if (e && e.overrideMimeType) {
            //     e.overrideMimeType("application/json;charset=UTF-8");
            // }
        },
        success: function(response) {
          var pendidikan_data = "";
          $.each(response.pendidikans, function(index, value) {
                            pendidikan_data += "<option value="+value.kode_sub+">"+value.nama_sub+"</option>";
                        });
            $(".subgrup").html(pendidikan_data);

            // console.log(pendidikan_data);
        },
        error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
            alert(xhr.status + "\n" + xhr.responseText + "\n" +
                thrownError); // Munculkan alert error
        }
    })
    
});
  </script>
  </body>
  </html>