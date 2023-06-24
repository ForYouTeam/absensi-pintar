<!DOCTYPE html>


<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed " dir="ltr" data-theme="theme-default" data-assets-path="sneat/" data-template="vertical-menu-template">

  
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Absensi Pintar</title>
    
    <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <link rel="stylesheet" href="{{ asset('sneat/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/fonts/flag-icons.css')}}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat/css/demo.css')}}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/apex-charts/apex-charts.css')}}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/datatables-select-bs5/select.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}">
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('sneat/vendor/js/helpers.js')}}"></script>
    <script src="{{ asset('sneat/vendor/js/template-customizer.js')}}"></script>
    <script src="{{ asset('sneat/js/config.js')}}"></script>
    
</head>

<body>
  
  <!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">

<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <div class="app-brand demo ">
      <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform: capitalize">Absen</span>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
          <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
  </div>

  <div class="menu-inner-shadow"></div>
  
  @include('Skelton.Nav')
  
</aside>    <!-- Layout container -->
  <div class="layout-page">

  @include('Skelton/Top')
  
<!-- / Navbar -->

      

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-fluid flex-grow-1 container-p-y">  

      @yield('content')

  </div>
</div>
@include('Skelton/Bottom')
@yield('js')
  
</body>


</html>

