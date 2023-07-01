@extends('skelton.Base')
@section('title')
    Absensi
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt--5" style="float: left">Data Absensi</h4>
                    <div class="float-end">
                        <button onclick="getDataByParams()" class="btn btn-primary" style="margin-top: 28px; margin-left: 40px">Filter</button>
                    </div>
                    <div class="float-end">
                        <label for="defaultSelect" class="form-label">Pilih Kelas</label>
                        <select style="width: 200px;" id="kelasSelect" class="form-select">
                        </select>
                    </div>
                    @hasrole('super-admin|admin')
                    <div class="float-end me-5">
                        <label for="defaultSelect" class="form-label">Pilih Guru</label>
                        <select style="width: 200px;" id="guruSelect" class="form-select">
                        </select>
                    </div>
                    @endhasrole
                   
                </div>
                <div class="card-body">
                    <table id="table-data" class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Mata Pelajaran</th>
                                <th>Tgl</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$d->siswa->nama}}</td>
                                    <td>{{$d->siswa->kelas->nama_kelas}}</td>
                                    <td>{{$d->siswa->jurusan->nama_jurusan}}</td>
                                    <td>{{$d->gate->mapel}}</td>
                                    <td>{{$d->tgl}} | {{$d->start_tap}}</td>
                                    <td>{{ $d->status == 1 ? 'hadir' : ($d->status == 0 ? 'alpa' : ($d->status == 3 ? 'bolos' : 'dalam kelas'))}}</td>
                                    <td>
                                        <button type="button" onclick="editPayload(event)" class=" btn btn-info btn-sm" data-id="{{$d->id}}" data-status="{{$d->status}}">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>N0</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Mata Pelajaran</th>
                                <th>Tgl</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>    
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="modal-data" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
          <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
              <div class="text-center mb-4">
                <h3 id="#modalheader" class="modal-title"></h3>
                <p class="text-primary"><b>JABATAN</b></p>
              </div>
              <form id="formData" class="row g-3" onsubmit="return false">
                @csrf
                <div class="col-12 my-4">
                  <label class="form-label w-100" for="modalAddCard">Status</label>
                  <div class="input-group input-group-merge mb-2">
                    <input type="hidden" name="id" id="id">
                    <select name="status" id="status" class="form-select">
                        <option value="0">Alpa</option>
                        <option value="1">Hadir</option>
                        <option value="3">Bolos</option>
                    </select>
                  </div>
				  <span class="text-danger small" id="nama-alert"></span>
                </div>
                <div class="col-12 text-center">
                  <button type="submit" id="btn-simpan" class="btn btn-outline-primary me-sm-3 me-1 mt-3 mx-1">Submit</button>
                  <button type="reset" class="btn btn-outline-danger btn-reset mt-3 mx-1" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
{{-- End Modal --}}
    @section('script')
    <script>
        let baseUrl

        function getKelas() {
            $.get(`${baseUrl}/api/v1/kelas`, function(res) {
                let item = res.data
                $('#kelasSelect').html(`<option value="0">-- Semua --</option>`)

                $.each(item, (i, d) => {
                    $('#kelasSelect').append(`
                        <option value="${d.id}">${d.nama_kelas}</option>
                    `)
                })
            })
        }

        function getGuru() {
            $.get(`${baseUrl}/api/v1/guru`, function(res) {
                let item = res.data
                $('#guruSelect').html(`<option value="0">-- Semua --</option>`)

                $.each(item, (i, d) => {
                    $('#guruSelect').append(`
                        <option value="${d.id}">${d.nama}</option>
                    `)
                })
            })
        }

        function getDataByParams() {
            let payload = {
                kelasId: $('#kelasSelect').val(),
                guruId: $('#guruSelect').val()
            }

            $.get(`${baseUrl}/api/v1/present/allbyparams?kelas_id=${payload.kelasId}&guru_id=${payload.guruId}`, function(res)
            {
                let data = res.data
                console.log(data);

                $('#tbody').html('')
                $.each(data, (i ,d ) => {
                    $('#tbody').append(`
                    <tr>
                        <td>${i + 1}</td>
                        <td>${d.nama}</td>
                        <td>${d.nama_kelas}</td>
                        <td>${d.nama_jurusan}</td>
                        <td>${d.mapel}</td>
                        <td>${d.tgl} | ${d.start_tap}</td>
                        <td>${d.status == 0 ? 'alpa' : (d.status == 1 ? 'hadir' : (d.status == 3 ? 'bolos' : 'dalam kelas'))}</td>
                        <td>
                            <button type="button" onclick="editPayload(event)" class="btn btn-info btn-sm" data-id="${d.id}" data-status="${d.status}">Edit</button>
                        </td>
                    </tr>
                    `)
                })
            })
        }

        $(document).ready(function() {
            baseUrl = "{{ config('app.url') }}"

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#table-data').DataTable();

            getKelas()
            getGuru()
        });

        function editPayload(event) {
            let id = $(event.target).data('id');
            let status = $(event.target).data('status');
            $('#modal-data').modal('show');
            $('.modal-title').html("Formulir Edit Data");
            $('#btn-simpan').val("edit-user");
            $('#status').val(status);
            $('#id').val(id);

            let idData =    $('#id').val();
            console.log(idData);
        }

        $('#btn-simpan').click(function (e) {
            e.preventDefault();
            let submitButton = $(this);
            submitButton.html('Simpan');

            if (!submitButton.prop('disabled')) {
                submitButton.prop('disabled', true);
                $.ajax({
                    data    : $('#formData').serialize()  ,
                    url     : `${baseUrl}/api/v1/present/update`,
                    type    : "POST"                      ,
                    dataType: 'json'                      ,
                    success: function(result) {
                        console.log(result);
                        Swal.fire({
                            title            : 'Success'               ,
                            text             : 'Data Berhasil diproses',
                            icon             : 'success'               ,
                            cancelButtonColor: '#d33'                  ,
                            confirmButtonText: 'Oke'
                        }).then((result) => {
                            location.reload();
                        });
                        $('#modal-data').modal('hide');
                    },
                    error: function(result) {
                        submitButton.prop('disabled', false);
                        if (result.status = 422) {
                            let data = result.responseJSON
                            let errorRes = data.errors;
                            if (errorRes.length >= 1) {
                                $('#nama-alert').html(errorRes.data.nama_jabatan);
                            }
                        } else {
                            let msg = 'Sedang pemeliharaan server'
                            iziToast.error(msg)
                        }
                    }
                });
            }
        });


    </script>
@endsection
@endsection