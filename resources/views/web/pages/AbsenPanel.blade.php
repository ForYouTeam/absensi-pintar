@extends('web.skelton.Base')
@section('content-header')
<div class="content-header row">
  <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block">SESI {{ $data->section }}</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item h4 mt-2"><a href="#">tap kartu untuk melakukan absensi</a>
          </li>
          <li class="breadcrumb-item h4 mt-2 ml-5">kelas: <span class="text-uppercase">{{ $data->kelas }}</span>
          </li>
          <li class="breadcrumb-item h4 mt-2 ml-5">Hadir: <span class="text-uppercase" id="total"></span>
          </li>
          <li class="ml-5">
            <fieldset class="form-label-group mt-2 mb-0">
              <input type="text" class="form-control input-form" id="rfid" value="" required="" autofocus="" onblur="preventBlur()">
              <label for="wallet-address">RFID CODE</label>
            </fieldset>
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
      <div id="log-body">
       
      </div>
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
                <i class=" font-large-3 bg-glow white rounded-circle p-3 d-inline-block" style="border: 1px solid gray;"><img style="height: 120px !important; width: auto;" id="imgScan" src="{{asset('app-assets/images/portrait/medium/avatar-m-1.png')}}" class="rounded-circle height-100" alt="Card image"></i>
              </div>
            </div>
            <h3 class="text-center" id="nama">
              
            </h3>
          </div>
          <div class="table-responsive">
            <table class="table table-de mb-0">                    
              <tbody>
                <tr>
                  <td>Nisn</td>
                  <td class="text-uppercase" id="nisn"></td>
                </tr>
                <tr>
                  <td>Kelas</td>
                  <td class="text-uppercase" id="kelas"></td>                        
                </tr>
                <tr>
                  <td>Jurusan</td>
                  <td class="text-uppercase" id="jurusan"></td>
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
@section('script')
  <script>
    let baseUrl = `{{config('app.url')}}`
    let payload = {
      gate_id : `{{$data->id}}` ,
      kelas_id: `{{$data->kelas_id}}`,
    }

    function setName(data) {
      $.each(data, (i, d) => {
        $(`#${i}`).html(d)
      })

      $('#imgScan').attr('src', `{{asset('storage/siswa/${data.foto}')}}`)
    }

    function formatDate(dateString) {
      let date = new Date(dateString);
      let options = { day: '2-digit', month: 'long', year: 'numeric' };
      let formattedDate = date.toLocaleDateString('id-ID', options);
      return formattedDate;
    }

    function getPayloadByQty() {
      $.get(`${baseUrl}/api/v1/present/getbyqty/${payload.gate_id}?gate_id={{$data->id}}&kelas_id={{$data->kelas_id}}`, (res) => {
        let data = res.data

        let totalHadir = res.total_hadir
        let totalSiswa = res.total_siswa

        $('#total').html(`
          ${totalHadir}/${totalSiswa}
        `)

        $('#log-body').html('')
        $.each(data, (i, d) => {
          $('#log-body').append(`
          <section class="card pull-up">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                          <div class="col-md-6 col-12 py-2">
                            <h3 class="text-left text-uppercase">
                              ${d.siswa}
                            </h3>
                          </div>
                          <div class="col-md-2 col-12 py-2 text-center">
                            <h5 style="margin-left: 20px">${formatDate(d.tgl)}</h5>
                          </div>
                          <div class="col-md-4 col-12 py-2 text-center">
                            <h5>`+ (d.end_tap ? `Keluar ${d.end_tap}` : `Masuk ${d.start_tap}`) +`</h5>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </section>
          `)
        })
      })
    }

    function absen() {
      $.ajax({
          type    : "POST",
          url     : `${baseUrl}/api/v1/present/start`,
          data    : payload,
          success : (res) => {
            $('#rfid').val('')
            iziToast.success({
              title   : 'Pesan'               ,
              message : res.message,
              position: 'topRight'
            });
            
            setName(res.data)
            console.log(res);
            getPayloadByQty()
          },
          error   : (err) => {
            let status = err.status
            if (status == 404) {
              iziToast.warning({
                  title   : 'Pesan',
                  message : err.responseJSON.message,
                  position: 'topRight'
              });
            }
            $('#rfid').val('')
          },
          dataType: "json"
      });
    }

    function preventBlur() {
      let input = document.getElementById("rfid");
      input.focus();
    }

    $(document).ready(function () {
      $('#rfid').keydown(function(event) {
        if (event.which === 13) {
          payload.rfid = $('#rfid').val()
          absen()
        }
      });

      getPayloadByQty()
    })
  </script>
@endsection