<style>
.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
    background-color: #ffffff;
    color: #080010;
}
/* [class*=sidebar-dark-] .sidebar a {
    color: #000000;
}
[class*=sidebar-dark-] .nav-header {
    background: inherit;
    color: #000000;
} */
</style>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <style>
      body {
  font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 
}
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" >
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                   <li class="nav-item d-none d-sm-inline-block">
                    <a href="Penjualan" class="nav-link">Penjualan</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="PelunasanPiutang" class="nav-link">Pembayaran</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true" style="color: black;">
                        <i class="fas fa-user-circle"></i> &nbsp Hai , {{Auth::user()->name}} &nbsp <i class="fas fa-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="{{url('Profile')}}" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <a href="{{url('ganpass')}}" class="dropdown-item">
                            <i class="fas fa-lock mr-2"></i> Ganti Password
                        </a>
                        <a href="{{url('Bantuan')}}" target="_blank" class="dropdown-item">
                            <i class="fa fa-question-circle mr-2"></i>Panduan
                        </a>
                        <a href="{{url('OpenTiket')}}" target="_blank" class="dropdown-item">
                            <i class="fa fa-question-circle mr-2"></i>Buka Tiket
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('actionlogout')}}" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#3f4095;">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <!-- <img src=">assets/dist/img/absenbg.png" alt="Logo" class="brand-image" style="opacity: .8"> -->
                <span class="brand-text font-weight-light">Wahana</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
          

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                       <?php
                       $dataid=Auth::user()->id;
                       $data = DB::table('tb_access_menu')
                                   ->join('tb_menu', 'tb_access_menu.id_menu', '=', 'tb_menu.id')
                                   ->where('id_user',$dataid)
                                   ->where('tampil','Y')
                                   ->groupBy('nama_menu')
                                   ->orderby('id')
                                   ->get();
                       ?>
                        @foreach ($data as $k => $penamaan)
                        <li class="nav-item @if($penamaan->nama_menu==$menuku) menu-open @endif" >
                            <a href="{{ url($penamaan->url)}}" class="nav-link @if($penamaan->nama_menu==$menuku) active @endif">
                                <i class="nav-icon {{$penamaan->icon}}"></i>
                                <p>
                                {{$penamaan->nama_menu}}
                                   @if($penamaan->url=='#')
                                    <i class="right fas fa-angle-left"></i>
                                   @endif
                                </p>
                            </a>
                            @if($penamaan->url=='#')
                            <?php
                                    $submenu = DB::table('tb_access_menu')
                                    ->join('tb_sub_menu', 'tb_access_menu.id_sub_menu', '=', 'tb_sub_menu.id_sub')
                                    ->where('id_user',$dataid)
                                    ->where('id_menu',$penamaan->id_menu)
                                    ->where('tampil','Y')
                                    ->orderBy('id_sub')
                                    ->get();
                                ?>
                                @foreach($submenu as $subnya)
                                 
                                    <ul class="nav nav-treeview" >
                                        <li class="nav-item">
                                            <a href="{{ url($subnya->url_sub)}}" class="nav-link @if($subnya->nama_sub==$namasub) active @endif">
                                            <i class="{{$subnya->icon}} nav-icon"></i>
                                            <p>{{$subnya->nama_sub}}</p>
                                            </a>
                                        </li>
                                    </ul>
                                @endforeach
                            @endif
                        </li>
                        @endforeach
                        <!--<li class="nav-header">ABSENSI</li>-->
                        <!--    <li class="nav-item">-->
                        <!--        <a href="{{ url('Absensi/Absen')}}" class="nav-link">-->
                        <!--            <i class="nav-icon far fa-file"></i>-->
                        <!--            <p>-->
                        <!--                Absensi-->
                        <!--            </p>-->
                        <!--        </a>-->
                        <!--    </li>-->
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        