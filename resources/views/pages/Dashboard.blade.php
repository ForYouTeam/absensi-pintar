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
                  <h5 class="card-title text-primary" style="margin-bottom: 1.5rem">Selamat Datang (nama admin). 🎉</h5>
                  <p class="mb-5">Selamat Datang di Aplikasi <span class="fw-bold">72%</span> more sales today. Check your new badge in your profile.</p>
      
                  <a href="javascript:;" class="btn btn-sm btn-label-primary">View Badges</a>
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
                      <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="Credit Card" class="rounded">
                    </div>
                  </div>
                  <span style="font-size: 14pt; font-weight: bold">Siswa</span>
                  <h3 class="card-title text-nowrap mb-1">{{$data['siswa']}}</h3>
                  <small class="text-primary fw-semibold"> ( TOTAL )</small>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="Credit Card" class="rounded">
                    </div>
                  </div>
                  <span style="font-size: 14pt; font-weight: bold">Guru</span>
                  <h3 class="card-title text-nowrap mb-1">{{$data['siswa']}}</h3>
                  <small class="text-primary fw-semibold"> ( TOTAL )</small>
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