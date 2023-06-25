@extends('skelton.Base')
@section('title')
    Guru
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt--5" style="float: left">Data Guru</h4>
                    <button id="createData" type="button" class="btn btn-primary" style="float: right">Tambah Data</button>
                </div>
                <div class="card-body">
                    <table id="table-data" class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>nama/nip</th>
                                <th>jenis kelamin</th>
                                <th>agama</th>
                                <th>status</th>
                                <th>jabatan</th>
                                <th>golongan</th>
                                <th>mapel</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="td-data">
                            @php
                                $no = 1;
                            @endphp
                          @foreach ($guru as $item)
                                <tr>
                                    <td style="width: 5%">{{$no++}}</td>
                                    <td>{{$item['nama']}} <br> {{$item['nip']}}</td>
                                    <td>{{$item['sex']}}</td>
                                    <td>{{$item['agama']}}</td>
                                    <td>{{$item['status']}}</td>
                                    <td>{{$item['jabatan']}}</td>
                                    <td>{{$item['golongan']}}</td>
                                    <td>{{$item['mapel']}}</td>
                                    <td style="width: 10%">
                                        <img src="{{ asset('storage/guru/' . $item['foto']) }}" style="width: 70%">
                                    </td>
                                    <td style="width: 15%">
                                        <button class="editItem btn-sm btn btn-info" data-id="{{$item->id}}">Edit</button>
                                        <button id="btn-hapus" class="btn-sm btn btn-danger" data-id="{{$item->id}}">Hapus</button>
                                    </td>
                                </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>N0</th>
                                <th>nama/nip</th>
                                <th>jenis kelamin</th>
                                <th>agama</th>
                                <th>status</th>
                                <th>jabatan</th>
                                <th>golongan</th>
                                <th>mapel</th>
                                <th>Foto</th>
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
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
          <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
              <div class="text-center mb-4">
                <h3 class="modal-title">Form Tambah Data</h3>
                <p class="text-primary"><b>GURU</b></p>
              </div>
              <form id="formData" class="row g-3" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserFirstName">nip</label>
                  <input type="text" id="nip" name="nip" class="form-control" placeholder="Masukan Nip" />
                  <span class="text-danger error-msg small" id="alert-nip"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserLastName">nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama" />
                    <span class="text-danger error-msg small" id="alert-nama"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserStatus">Jenis Kelamin</label>
                    <select id="sex" name="sex" class="form-select" aria-label="Default select example">
                        <option value="" selected disabled>-- Pilih --</option>
                        <option value="Wanita">Perempuan</option>
                        <option value="Pria">Laki-Laki</option>
                    </select>
                    <span class="text-danger error-msg small" id="alert-sex"></span>
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserFirstName">Agama</label>
                  <input type="text" id="agama" name="agama" class="form-control" placeholder="Masukan Agama" />
                  <span class="text-danger error-msg small" id="alert-agama"></span>
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserLastName">Status</label>
                  <input type="text" id="status" name="status" class="form-control" placeholder="Status" />
                  <span class="text-danger error-msg small" id="alert-status"></span>
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserFirstName">golongan</label>
                  <input type="text" id="golongan" name="golongan" class="form-control" placeholder="Masukan Golongan" />
                  <span class="text-danger error-msg small" id="alert-golongan"></span>
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserStatus">Jabatan</label>
                  <select id="jabatan_id" name="jabatan_id" class="form-select" aria-label="Default select example">
                        <option value="" selected>-- Pilih --</option>
                        @foreach ($jabatan as $d)
                        <option value="{{$d->id}}">{{$d->nama_jabatan}}</option>
                        @endforeach
                  </select>
                  <span class="text-danger error-msg small" id="alert-jabatan"></span>

                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserStatus">mapel</label>
                    <select id="mapel_id" name="mapel_id" class="form-select" aria-label="Default select example">
                          <option value="" selected>-- Pilih --</option>
                          @foreach ($mapel as $d)
                          <option value="{{$d->id}}">{{$d->nama_mapel}}</option>
                          @endforeach
                    </select>
                    <span class="text-danger error-msg small" id="alert-mapel"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserFirstName">rfid</label>
                    <input type="text" id="rfid" name="rfid" class="form-control mb-2" placeholder="Masukan Golongan" />
                    <span class="text-danger error-msg small" id="alert-rfid"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserFirstName">Foto</label>
                    <input type="file" id="foto" name="foto" class="form-control mb-1" placeholder="Masukan Golongan" />
                </div>
                <div class="col-12 text-center">
                    <button type="button" id="btn-simpan" class="btn btn-outline-primary">Submit</button>
                    <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
{{-- End Modal --}}

    @section('script')
    <script>
        let BaseUrl

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#table-data').DataTable();

            BaseUrl = "{{config('app.url')}}"
        });

        function clearError() {
            $('.error-msg').html('')
        }

        $('#createData').click(function () {
            $('.modal-title').html   ("Form Tambah Data");
            $('#btn-simpan' ).val    ("create-Item"     );
            $('#id'         ).val    (''                );
            $('#formData'   ).trigger("reset"           );
            $('#modal-data' ).modal  ('show'            );
            clearError()
        });

        $('body').on('click', '.editItem', function () {
            var _id = $(this).data('id');
            $.get( BaseUrl + "/api/v1/guru/" + _id, function (res) {
                $('.modal-title').html("Form Edit Data"   );
                $('#btn-simpan' ).val ("edit-user"        );
                clearError()
                $('#modal-data').modal('show'             );
                $('#id'        ).val  (res.data.id        );
                $('#nip'       ).val  (res.data.nip       );
                $('#nama'      ).val  (res.data.nama      );
                $('#sex'       ).val  (res.data.sex       );
                $('#agama'     ).val  (res.data.agama     );
                $('#status'    ).val  (res.data.status    );
                $('#golongan'  ).val  (res.data.golongan  );
                $('#jabatan_id').val  (res.data.jabatan_id);
                $('#mapel_id'  ).val  (res.data.mapel_id  );
                $('#rfid'      ).val  (res.data.rfid      );
                $('#foto'      ).val  (res.data.foto      );
            })
        });

        $('#btn-simpan').click(function (e) {
            e.preventDefault();
            $(this).html('Simpan');
            let submitButton = $(this).prop('disabled')

            if(!submitButton){
                // $(this).prop('disabled', true);
                let foto = $('#foto').prop('files')[0]
                let data = new FormData($('#formData')[0]);
                $.ajax({
                    url        : `${BaseUrl}/api/v1/guru/`,
                    method     : "POST"                   ,
                    data       : data                     ,
                    cache      : false                    ,
                    contentType: false                    ,
                    processData: false                    ,
                    success: function(result) {
                        let data = result.data;
                            Swal.fire({
                                title            : 'Success'                ,
                                text             : 'Data Berhasil diproses.',
                                icon             : 'success'                ,
                                cancelButtonColor: '#d33'                   ,
                                confirmButtonText: 'Oke'
                            }).then((result) => {
                                location.reload();
                            });
                            $('#modal-data').modal('hide');
                    },
                    error: function(result) {
                        if (result.status = 422) {
                            let data = result.responseJSON
                            let errorRes = data.errors;
                            if (errorRes.length >= 1) {
                                $('#alert-nip'     ).html(errorRes.data.nip       );
                                $('#alert-nama'    ).html(errorRes.data.nama      );
                                $('#alert-agama'   ).html(errorRes.data.agama     );
                                $('#alert-sex'     ).html(errorRes.data.sex       );
                                $('#alert-status'  ).html(errorRes.data.status    );
                                $('#alert-golongan').html(errorRes.data.golongan  );
                                $('#alert-jabatan' ).html(errorRes.data.jabatan_id);
                                $('#alert-mapel'   ).html(errorRes.data.mapel_id  );
                                $('#alert-rfid'    ).html(errorRes.data.rfid      );
                            }
                        } else {
                            let msg = 'Sedang pemeliharaan server'
                            iziToast.error(msg)
                        }
                    }
                });
            }
        });

        $(document).on('click', '#btn-hapus', function() {
            let _id = $(this).data('id');
            let url = "http://127.0.0.1:8000/api/v1/guru/" + _id;
            Swal.fire({
                title             : 'Anda Yakin?',
                text              : "Data ini mungkin terhubung ke tabel yang lain!",
                icon              : 'warning',
                showCancelButton  : true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor : '#d33',
                cancelButtonText  : 'Batal',
                confirmButtonText : 'Hapus'
            }).then((res) => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'delete',
                        success: function(result) {
                            let data = result.data;
                            Swal.fire({
                                title            : 'Success'               ,
                                text             : 'Data Berhasil Dihapus.',
                                icon             : 'success'               ,
                                cancelButtonColor: '#d33'                  ,
                                confirmButtonText: 'Oke'
                            }).then((result) => {
                                location.reload();
                            });
                        },
                        error: function(result) {
                            let data = result.responseJSON
                            Swal.fire({
                                icon : 'error'              ,
                                title: 'Error'              ,
                                text : data.response.message,
                            });
                        }
                    });
                }
            })
        });
    </script>
@endsection
@endsection