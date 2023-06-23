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
    {{ Route::is('data.kelas') || Route::is('data.jurusan') || Route::is('data.jabatan') || Route::is('data.mapel') || Route::is('data.guru') || Route::is('data.siswa') || Route::is('data.ketentuan') ? 'active' : '' }}
    ">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="Layouts">Data</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ Route::is('data.guru') ? 'active' : '' }}">
          <a href="{{route('data.guru')}}" class="menu-link">
            <div data-i18n="Without menu">Guru</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('data.siswa') ? 'active' : '' }}">
          <a href="{{route('data.siswa')}}" class="menu-link">
            <div data-i18n="Without navbar">Siswa</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('data.kelas') ? 'active' : '' }}">
          <a href="{{route('data.kelas')}}" class="menu-link">
            <div data-i18n="Collapsed menu">Kelas</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('data.jurusan') ? 'active' : '' }}">
          <a href="{{route('data.jurusan')}}" class="menu-link">
            <div data-i18n="Content navbar">Jurusan</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('data.jabatan') ? 'active' : '' }}">
          <a href="{{route('data.jabatan')}}" class="menu-link">
            <div data-i18n="Content nav + Sidebar">Jabatan</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('data.mapel') ? 'active' : '' }}">
          <a href="{{route('data.mapel')}}" class="menu-link">
            <div data-i18n="Horizontal">Mapel</div>
          </a>
        </li>
        <li class="menu-item {{ Route::is('data.ketentuan') ? 'active' : '' }}">
          <a href="{{route('data.ketentuan')}}" class="menu-link">
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