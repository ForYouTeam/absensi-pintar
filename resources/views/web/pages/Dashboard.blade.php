@extends('web.skelton.Base')
@section('content')
<div class="row">
  <div class="col-12">
      <div class="card pull-up">
          <div class="card-content collapse show">
              <div class="card-body">
                  <form class="form-horizontal form-purchase-token row">
                      <div class="col-md-3 col-12">
                          <select onchange="inputCheck()" id="kelas_id" class="custom-select input-form">
                              <option disabled selected="" value="">PILIH KELAS</option>
                              @foreach ($data['kelas'] as $d)
                                  <option class="text-uppercase" value="{{ $d->id }}">{{ $d->nama_kelas }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-md-3 col-12">
                        <select onchange="inputCheck()" id="mapel" class="custom-select input-form">
                            <option disabled selected="" value="">PILIH MATA PELAJARAN</option>
                            @foreach ($data['mapel'] as $d)
                                <option class="text-uppercase" value="{{ $d->nama_mapel }}">{{ $d->nama_mapel }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col-md-2 col-12 mb-1">
                        <fieldset class="form-label-group mb-0">
                            <input type="text" class="form-control input-form" id="wallet-address" value="" required="" autofocus="">
                            <label for="wallet-address">PASSWORD</label>
                        </fieldset>
                      </div>
                      <div class="col-md-2 col-12 mb-1">
                        <fieldset class="form-label-group mb-0">
                            <input type="text" class="form-control input-form" id="rfid" value="" required="" autofocus="" disabled>
                            <label for="wallet-address">RFID</label>
                        </fieldset>
                      </div>
                      <div class="col-md-2 col-12 text-center">
                        <button type="button" class="btn-gradient-secondary">TEMPELKAN KARTU</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="row">
  <div id="recent-transactions" class="col-12">
      <h6 class="my-2">Kelas yang aktif hari ini</h6>
      <div class="card">
          <div class="card-content">
              <div class="table-responsive">
                  <table id="recent-orders" class="table table-hover table-xl mb-0">
                      <thead>
                          <tr>
                              <th class="border-top-0">Sesi Aktif</th>
                              <th style="width: 25%;" class="border-top-0">Guru</th>
                              <th class="border-top-0">Matapelajaran</th>
                              <th class="border-top-0">Jam Dimulai</th>
                              <th style="width: 15%" class="border-top-0">Opsi</th>
                          </tr>
                      </thead>
                      <tbody id="logBody">
                          
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
@section('script')
<script>
    let baseUrl

    function addSection() {
        $('#rfid').focus()
        $('#addPanel').html('SCAN RFID')
    }

    function clearInput() {
        $('#rfid' ).val ('')
        // $('#rfid').prop('disabled', true)
        $('#rfid').focus()
    }

    function openGate() {
        let data = {
            kelas_id : $('#kelas_id').val(),
            mapel    : $('#mapel'   ).val(),
            rfid     : $('#rfid'    ).val()
        }

        $.ajax({
            type    : "POST",
            url     : `${baseUrl}/api/v1/gate/open`,
            data    : data,
            success : (res) => {
                getPanelData()
                clearInput()
                iziToast.success({
                    title   : 'Pesan'               ,
                    message : 'Sesi berhasil dibuat',
                    position: 'topRight'
                });
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
                clearInput()
            },
            dataType: "json"
        });
    }

    function getPanelData() {
        $.get(`${baseUrl}/api/v1/gate/all`, function(res) {
            $('#logBody').html('')
            $.each(res.data, (i, d) => {
                $('#logBody').append(`
                <tr>
                    <td class="text-truncate"><i class="la la-dot-circle-o success font-medium-1"></i>${d.section}</td>
                    <td class="text-truncate text-capitalize">${d.guru}</td>
                    <td class="text-truncate">
                        <a href="#" class="mb-0 btn-sm btn btn-outline-success round text-capitalize">${d.mapel}</a>
                    </td>
                    <td class="text-truncate">${d.open}</td>
                    <td>
                        <a href="${baseUrl}/dashboard/${d.section}" class="btn-link rounded">Buka Panel</a>
                        <a href="#" role="button" onClick="sectionClose(event)" data-id="${d.section.split("_")[1]}" class="btn-link text-danger rounded ml-3">Tutup Sesi</a>
                    </td>
                </tr>
                `)
            })
        });
    }

    function inputCheck() {
        let input1      = $("#kelas_id");
        let input2      = $("#mapel");
        let targetInput = $("#rfid");

        input1.on("input", checkInputs);
        input2.on("input", checkInputs);

        function checkInputs() {
            if (input1.val() && input2.val()) {
            targetInput.prop("disabled", false);
            targetInput.focus()
            } else {
            targetInput.prop("disabled", true);
            }
        }
    }

    function sectionClose(event) {
        let dataId = event.target.dataset.id
        Swal.fire({
            title             : 'Tutup Session?',
            text              : "Sesi ini tidak dapat dipulihkan kembali!",
            icon              : 'question',
            showCancelButton  : true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor : '#d33',
            cancelButtonText  : 'Batal',
            confirmButtonText : 'Proses'
        }).then((res) => {
            if (res.isConfirmed) {
                $.get(`${baseUrl}/api/v1/gate/close/${dataId}`, function()
                {
                    iziToast.success({
                        title   : 'Pesan'               ,
                        message : 'Sesi berhasil ditutup',
                        position: 'topRight'
                    });
                })
                setTimeout(() => {
                    getPanelData() 
                }, 500);
            }
        })
    }

    $(document).ready(function (){
        baseUrl = "{{config('app.url')}}"

        $('#rfid').keydown(function(event) {
            if (event.which === 13) {
                $('#addPanel').html('TAMBAH SESI')
                openGate()
            }
        });

        getPanelData()
    })

</script>
@endsection