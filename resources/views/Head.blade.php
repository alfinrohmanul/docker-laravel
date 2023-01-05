<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>POS || WAHANA</title>
    <link rel="shortcut icon" href="{{ url('assets/dist/img/maskot.png')}}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css'); }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css');}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css')}}">
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"> -->
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <script src="{{ url('assets/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{ url('assets/plugins/select2/css/select2.min.css'); }}">
<link rel="stylesheet" href="{{ url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); }}">

      <link rel="stylesheet" href="{{ url('assets/sweetalert.css')}}">
      @toastr_css
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <link rel="stylesheet" href="{{ url('assets/wis.css')}}">
 
      <style>
          .main-footer {
  background: #e9551c;
  border-top: 1px solid #dee2e6;
  color: #ffffff;
  padding: 1rem;
}
.a{
  color:#000000;
}

.nav-pad {
      padding-left: 15px;
    }

    
      </style>
      <style>
  .table-pilihan th {
  cursor: pointer;
}

.table-pilihan .th-sort-asc::after {
  content: "\25b4";
}

.table-pilihan .th-sort-desc::after {
  content: "\25be";
}

.table-pilihan .th-sort-asc::after,
.table-pilihan .th-sort-desc::after {
  margin-left: 5px;
}

.table-pilihan .th-sort-asc,
.table-pilihan .th-sort-desc {
  background: rgba(0, 0, 0, 0.1);
}

  </style>
