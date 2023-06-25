@extends('web.skelton.Base')
@section('content-header')
<div class="content-header row">
  <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block">SESI {{ $section }}</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">tap kartu untuk melakukan absensi</a>
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>
@endsection
@section('content')

<div class="content-detached content-left">
  <div class="content-body"><div id="wallet">
      <div class="wallet-table-th d-none d-md-block">
        <div class="row">
            <div class="col-md-6 col-12 py-1">
                <p class="mt-0 text-capitalize">Log kehadiran</p>
            </div>
            <div class="col-md-2 col-12 py-1 text-center">
                <p class="mt-0 text-capitalize">Tanggal Waktu</p>
            </div>
            <div class="col-md-4 col-12 py-1 text-center">
                <p class="mt-0 text-capitalize"></p>
            </div>
        </div>
      </div>
<!-- BTC -->
      <section class="card pull-up">
        <div class="card-content">
            <div class="card-body">
                <div class="col-12">
                    <div class="row">
                      <div class="col-md-6 col-12 py-2">
                        <h3 class="text-left">
                          @if(strlen('irwandi paputungan') > 30)
                            {{ substr('irwandi paputungan', 0, 30) }}...
                          @else
                            {{ 'irwandi paputungan' }}
                          @endif
                        </h3>
                      </div>
                      <div class="col-md-2 col-12 py-2 text-center">
                        <h5 style="margin-left: 20px">25 JUNI 2023</h5>
                      </div>
                      <div class="col-md-4 col-12 py-2 text-center">
                        <h5>Waktu masuk 22:00</h5>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
    </div>
  </div>
</div>

<div class="sidebar-detached sidebar-right" =""="">
  <div class="sidebar"><div id="wallet-sidebar" class="sidebar-content">
    <div class="row">
      <p class="py-1 text-capitalize col-12">Data Siswa</p>
    </div>
    <div class="card">
      <div class="card-header">
          <h6 class="card-title text-center">SCANNER</h6>            
      </div>
        <div class="card-content collapse show">
          <div class="card-body">
            <div class="text-center row clearfix mb-2">
              <div class="col-12">
                <i class=" font-large-3 bg-warning bg-glow white rounded-circle p-3 d-inline-block"><img style="height: 160px !important" src="{{asset('app-assets/images/portrait/medium/avatar-m-1.png')}}" class="rounded-circle height-100" alt="Card image"></i>
              </div>
            </div>
            <h3 class="text-center">
              @if(strlen('irwandi paputungan') > 16)
                {{ substr('irwandi paputungan', 0, 16) }}...
              @else
                {{ 'irwandi paputungan' }}
              @endif
            </h3>
          </div>
          <div class="table-responsive">
            <table class="table table-de mb-0">                    
              <tbody>
                <tr>
                  <td>Nisn</td>
                  <td><i class="icon-layers"></i> 3,258 CIC</td>
                </tr>
                <tr>
                  <td>Kelas</td>
                  <td><i class="icon-layers"></i> 200.88 CIC</td>                        
                </tr>
                <tr>
                  <td>Jurusan</td>
                  <td><i class="cc BTC-alt"></i> 0.0001 BTC</td>
                </tr>                  
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection