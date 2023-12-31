@extends('skelton.Base')
@section('title')
    Akun
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt--5" style="float: left">Data Akun</h4>
                    <button id="createData" type="button" class="btn btn-primary" style="float: right">Tambah Data</button>
                </div>
                <div class="card-body">
                    <table id="table-data" class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Username</th>
                                <th>Scope</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                          @foreach ($data['akun'] as $item)
                            @if ($item['scope'] != 'super-admin')
                                <tr>
                                    <td style="width: 5%">{{$no++}}</td>
                                    <td style="width: 50%">{{ $item['username'] }}</td>
                                    <td>{{ $item['scope'] }}</td>
                                    <td style="width: 15%">
                                        <button class="editItem btn btn-sm btn-info" data-id="{{$item->id}}">Edit</button>
                                        <button id="btn-hapus" class="btn btn-sm btn-danger" data-id="{{$item->id}}">Hapus</button>
                                    </td>
                                </tr>
                            @endif
                          @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>N0</th>
                                <th>Username</th>
                                <th>scope</th>
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
                <p class="text-primary"><b>AKUN</b></p>
              </div>
              <form id="formData" class="row g-3" onsubmit="return false">
                @csrf
                <div class="col-12 my-2">
                  <label class="form-label w-100" for="modalAddCard">username</label>
                    <input type="hidden" name="id" id="dataId">
                    <input id="username" name="username" class="form-control credit-card-mask" type="text" placeholder="username" required>
				  <span class="text-danger small" id="alert-username"></span>
                </div>
                <div class="col-12 my-2">
                    <label class="form-label w-100" for="modalAddCard">password</label>
                      <input id="password" name="password" class="form-control credit-card-mask" type="password" placeholder="password" required>
                    <span class="text-danger small" id="alert-password"></span>
                </div>
                <div class="col-12 my-2 scope">
                    <label class="form-label w-100" for="modalAddCard">scope</label>
                        <select id="scope" name="scope" class="form-select" aria-label="Default select example">
                            <option value="" selected disabled>-- Pilih --</option>
                            <option value="admin">Admin</option>
                            <option value="guru">Guru</option>
                        </select>
                        <span class="text-danger error-msg small" id="alert-password"></span>
                </div>
                <div class="col-12 my-2 guru">
                    <label class="form-label w-100" for="modalAddCard">Guru</label>
                        <select id="guru_id" name="guru_id" class="form-select" aria-label="Default select example">
                            <option value="" selected disabled>-- Pilih --</option>
                            @foreach ($data['guru'] as $i)
                                <option value="{{$i->id}}">{{$i->nama}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-msg small" id="alert-password"></span>
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

        $(document).ready(function() {
            baseUrl = "{{ config('app.url') }}"

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#table-data').DataTable();
        });
        

        $('#createData').click(function () {
            $('.modal-title' ).html    ("Formulir Tambah Data");
            $('#btn-simpan'  ).val     ("create-Item"         );
            $('#id'          ).val     (''                    );
            $('#formData'    ).trigger ("reset"               );
            $('#modal-data'  ).modal   ('show'                );
            $('.guru'     ).hide    (                      );
            $('#nama-alert'  ).html    (''                    );
        });

        $('#scope').change( function () {
            let scope = $('#scope').val();
            if (scope == 'guru') {
                $('.guru').show();
            }
        })

        $('body').on('click', '.editItem', function () {
            var _id = $(this).data('id');
            $.get(`${baseUrl}/api/v1/akun/` + _id, function (res) {
                $('.modal-title' ).html  ("Formulir Edit Data"                  );
                $('#btn-simpan'  ).val   ("edit-user"                           );
                $('#password'    ).attr  ('placeholder', 'Masukan password baru');
                $('#modal-data'  ).modal ('show'                                );
                $('.scope'       ).hide  (                                      );
                $('.guru'        ).hide  (                                      );
                $('#username'    ).val   (res.data.username                     );
                $('#password'    ).val   (res.data.password                     );
                $('#dataId'      ).val   (res.data.id                           );
            })
        });

        

        $('#btn-simpan').click(function (e) {
            e.preventDefault();
            let submitButton = $(this);
            submitButton.html('Simpan');

            if (!submitButton.prop('disabled')) {
                submitButton.prop('disabled', true);
                $.ajax({
                    data    : $('#formData').serialize()  ,
                    url     : `${baseUrl}/api/v1/akun`,
                    type    : "POST"                      ,
                    dataType: 'json'                      ,
                    success: function(result) {
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
                                $('#alert-username').html(errorRes.data.username);
                                $('#alert-password').html(errorRes.data.password);
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
            let url = `${baseUrl}/api/v1/akun/` + _id;
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
                            let msg
                            if (result.responseJSON) {
                                let data = result.responseJSON
                                message  = data.message
                            } else {
                                msg = 'Sedang pemeliharaan server'
                            }
                            iziToast.error(msg)
                        }
                    });
                }
            })
        });
    </script>
@endsection
@endsection