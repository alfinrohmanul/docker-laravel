@include('Head')
@include('Menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box text-white" style="background-color:#3f4095;">
                        <div class="inner">
                            <h3>{{rupiahtampil($omzet)}}</h3>

                            <p>Total Omzet</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-arrow-graph-up-right"></i>
                        </div>
                        <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box text-white" style="background-color:#3f4095;">
                        <div class="inner">
                            <h3>{{rupiahtampil($penjualan)}}</h3>

                            <p>Penjualan Hari ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-arrow-graph-up-right"></i>
                        </div>
                        <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box text-white" style="background-color:#3f4095;">
                        <div class="inner">
                            <h3>{{rupiahtampil($diterima)}}</h3>

                            <p>Uang Di Terima Hari ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-arrow-graph-down-left"></i>
                        </div>
                        <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box text-white" style="background-color:#3f4095;">
                        <div class="inner">
                        <h3>{{rupiahtampil($piutang)}}</h3>

                            <p>Piutang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-arrow-graph-down-left"></i>
                        </div>
                        <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <hr>
                <!-- ./col -->
               
            </div>
            <!-- /.row -->
            <hr>
          <div class="row">
            <img src="{{ url('assets/dist/img/logowahana.png')}}" class="rounded mx-auto d-block" alt="wahana">
          </div>
        
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('Tag')
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('Foot')