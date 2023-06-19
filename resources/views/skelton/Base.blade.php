<!DOCTYPE html>


<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed " dir="ltr" data-theme="theme-default" data-assets-path="sneat/" data-template="vertical-menu-template">

  
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>
    
    <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    {{-- <link rel="canonical" href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/">

    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet"> --}}

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('sneat/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/fonts/flag-icons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('sneat/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/apex-charts/apex-charts.css')}}" />

    <!-- Page CSS -->
    
    <!-- Helpers -->
    <script src="{{ asset('sneat/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('sneat/vendor/js/template-customizer.js')}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('sneat/js/config.js')}}"></script>
</head>

<body>

  
  <!-- Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  {{-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript> --}}
  <!-- End Google Tag Manager (noscript) -->
  
  <!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">

<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

<div class="app-brand demo ">
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>
  
  @include('skelton.Nav')
  
</aside>    <!-- Layout container -->
  <div class="layout-page">

  @include('skelton/Top')
  
<!-- / Navbar -->

      

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">  

      <div class="row">
        <div class="col-lg-8 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                  <p class="mb-4">You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in your profile.</p>
      
                  <a href="javascript:;" class="btn btn-sm btn-label-primary">View Badges</a>
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img src="sneat/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.html">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
          <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body pb-0">
                  <span class="d-block fw-semibold mb-1">Order</span>
                  <h3 class="card-title mb-1">276k</h3>
                </div>
                <div id="orderChart" class="mb-3"></div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="sneat/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
                    </div>
                    <div class="dropdown">
                      <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                      </div>
                    </div>
                  </div>
                  <span>Sales</span>
                  <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                  <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.42%</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Total Revenue -->
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
          <div class="card">
            <div class="row row-bordered g-0">
              <div class="col-md-8">
                <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                <div id="totalRevenueChart" class="px-2"></div>
              </div>
              <div class="col-md-4">
                <div class="card-body">
                  <div class="text-center">
                    <div class="dropdown">
                      <button class="btn btn-sm btn-label-primary dropdown-toggle" type="button" id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        2022
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                        <a class="dropdown-item" href="javascript:void(0);">2021</a>
                        <a class="dropdown-item" href="javascript:void(0);">2020</a>
                        <a class="dropdown-item" href="javascript:void(0);">2019</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="growthChart"></div>
                <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>
      
                <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                  <div class="d-flex">
                    <div class="me-2">
                      <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                    </div>
                    <div class="d-flex flex-column">
                      <small>2022</small>
                      <h6 class="mb-0">$32.5k</h6>
                    </div>
                  </div>
                  <div class="d-flex">
                    <div class="me-2">
                      <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                    </div>
                    <div class="d-flex flex-column">
                      <small>2021</small>
                      <h6 class="mb-0">$41.2k</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Total Revenue -->
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
          <div class="row">
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="sneat/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded">
                    </div>
                    <div class="dropdown">
                      <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                      </div>
                    </div>
                  </div>
                  <span class="d-block mb-1">Payments</span>
                  <h3 class="card-title text-nowrap mb-2">$2,456</h3>
                  <small class="text-danger fw-semibold"><i class='bx bx-down-arrow-alt'></i> -14.82%</small>
                </div>
              </div>
            </div>
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body pb-2">
                  <span class="d-block fw-semibold mb-1">Revenue</span>
                  <h3 class="card-title mb-1">425k</h3>
                  <div id="revenueChart"></div>
                </div>
              </div>
            </div>
            <!-- </div>
          <div class="row"> -->
            <div class="col-12 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2">Profile Report</h5>
                        <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                      </div>
                      <div class="mt-sm-auto">
                        <small class="text-success text-nowrap fw-semibold"><i class='bx bx-chevron-up'></i> 68.2%</small>
                        <h3 class="mb-0">$84,686k</h3>
                      </div>
                    </div>
                    <div id="profileReportChart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
</div>
       

<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
  <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
    <div class="mb-2 mb-md-0">
      © <script>
      document.write(new Date().getFullYear())
      </script>
      , made with ❤️ by <a href="https://themeselection.com/" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
    </div>
    <div>
      
      <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
      <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>
      
      <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>
      
      
      <a href="https://themeselection.com/support/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
      
    </div>
  </div>
</footer>
<!-- / Footer -->

          
          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    
    
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    
    
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
    
  </div>
  

  

  <!-- Core JS -->
  <!-- build:js vendor/js/core.js -->
  <script src="{{ asset('sneat/vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{ asset('sneat/vendor/libs/popper/popper.js')}}"></script>
  <script src="{{ asset('sneat/vendor/js/bootstrap.js')}}"></script>
  <script src="{{ asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
  <script src="{{ asset('sneat/vendor/libs/hammer/hammer.js')}}"></script>
  <script src="{{ asset('sneat/vendor/libs/i18n/i18n.js')}}"></script>
  <script src="{{ asset('sneat/vendor/libs/typeahead-js/typeahead.js')}}"></script>
  <script src="{{ asset('sneat/vendor/js/menu.js')}}"></script>
  <script src="{{ asset('sneat/vendor/libs/apex-charts/apexcharts.js')}}"></script>
  <script src="{{ asset('sneat/js/main.js')}}"></script>
  <script src="{{ asset('sneat/js/dashboards-analytics.js')}}"></script>
  
</body>


</html>

