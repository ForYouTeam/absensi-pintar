<nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
      </a>
    </div>
    

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

      
      <!-- Search -->
      <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
          <a class="nav-item nav-link search-toggler px-0" href="{{route('dashboard')}}">
            <i class="bx bx-calendar bx-sm text-primary"></i>
            <span class="d-none d-md-inline-block text-dark">Dashboard / @yield('title')</span>
          </a>
        </div>
      </div>
     

      <ul class="navbar-nav flex-row align-items-center ms-auto">
        
        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
          <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
              <img src="sneat/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle">
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="pages-account-settings-account.html">
                <i class="bx bx-cog me-2 text-primary"></i>
                <span class="align-middle">Settings</span>
              </a>
            </li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a class="dropdown-item" href="auth-login-cover.html" target="_blank">
                <i class="bx bx-power-off me-2 text-danger"></i>
                <span class="align-middle">Log Out</span>
              </a>
            </li>
          </ul>
        </li>
        <!--/ User -->

      </ul>
    </div>
</nav>