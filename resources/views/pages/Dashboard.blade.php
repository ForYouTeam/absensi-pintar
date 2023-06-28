@extends('skelton.Base')
@section('title')
    Home
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary" style="margin-bottom: 1.5rem">Selamat Datang, 
                    {{-- @auth --}}
                        {{ Auth::user()->username }}. 🎉
                    {{-- @endauth.  --}}
                  </h5>
                  <p class="mb-5">Selamat Datang di Aplikasi Absensi Pada Sekolah SMA K GPID SUMBERSARI, Silahkan klik dibawah ini untuk pergi ke halaman dashboard Absensi .<a href="{{route('dashboard-panel')}}" class="btn btn-primary btn-md mt-3"> Halaman Presensi </a></p>
    
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img src="{{asset('assets/img/jadwal.svg')}}" height="190" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.html">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
          <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="Credit Card" class="rounded" style="height: 3rem; width: 3rem; margin-bottom: 1rem;">
                    </div>
                  </div>
                  <span style="font-size: 14pt; font-weight: bold;">Siswa</span>
                  <h3 class="card-title text-nowrap mt-2 mb-2">{{$data['siswa']}}</h3>
                  <small class="text-primary fw-semibold"> <a class="btn btn-primary btn-sm" href="{{route('pages.siswa')}}"> LIHAT DISINI </a></small>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="Credit Card" style="height: 3rem; width: 3rem; margin-bottom: 1rem;" class="rounded">
                    </div>
                  </div>
                  <span style="font-size: 14pt; font-weight: bold">Guru</span>
                  <h3 class="card-title text-nowrap mb-2 mt-2">{{$data['siswa']}}</h3>
                  <small class="text-primary fw-semibold"> <a class="btn btn-primary btn-sm" href="{{route('pages.guru')}}"> LIHAT DISINI</a></small>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
      $(document).ready(function() {
        $('#table-data').DataTable();
    });
    </script>
@endsection