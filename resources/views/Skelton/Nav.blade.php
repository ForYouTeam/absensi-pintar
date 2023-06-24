<ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
      <a href="{{route('dashboard')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Email">Dashboard</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="app-email.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-calendar"></i>
        <div data-i18n="Email">Absensi</div>
      </a>
    </li>

    <!-- Layouts -->
    <li class="menu-item open 
    {{ Route::is('pages.kelas') || Route::is('pages.jurusan') || Route::is('pages.jabatan') || Route::is('pages.mapel') || Route::is('pages.guru') || Route::is('pages.siswa') || Route::is('pages.ketentuan') ? 'active' : '' }}
    ">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="Layouts">Data</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ Route::is('pages.guru') ? 'active' : '' }}">
          <a href="{{route('pages.guru')}}" class="menu-link">
            <div data-i18n="Without menu">Guru</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('pages.siswa') ? 'active' : '' }}">
          <a href="{{route('pages.siswa')}}" class="menu-link">
            <div data-i18n="Without navbar">Siswa</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('pages.kelas') ? 'active' : '' }}">
          <a href="{{route('pages.kelas')}}" class="menu-link">
            <div data-i18n="Collapsed menu">Kelas</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('pages.jurusan') ? 'active' : '' }}">
          <a href="{{route('pages.jurusan')}}" class="menu-link">
            <div data-i18n="Content navbar">Jurusan</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('pages.jabatan') ? 'active' : '' }}">
          <a href="{{route('pages.jabatan')}}" class="menu-link">
            <div data-i18n="Content nav + Sidebar">Jabatan</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('pages.mapel') ? 'active' : '' }}">
          <a href="{{route('pages.mapel')}}" class="menu-link">
            <div data-i18n="Horizontal">Mapel</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('pages.ketentuan') ? 'active' : '' }}">
          <a href="{{route('pages.ketentuan')}}" class="menu-link">
            <div data-i18n="Horizontal">Ketentuan</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item">
      <a href="" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Email">Manage User</div>
      </a>
    </li>
  </ul>