@extends('skelton.Base')
@section('title')
    Ketentuan
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt--5" style="float: left">Data Ketentuan</h4>
                    <button id="createData" type="button" class="btn btn-primary" style="float: right">Tambah Data</button>
                </div>
                <div class="card-body">
                    <table id="table-data" class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>start</th>
                                <th>end</th>
                                <th>tipe</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                          @foreach ($data as $item)
                                <tr>
                                    <td style="width: 5%">{{$no++}}</td>
                                    <td>{{ $item['start'] }}</td>
                                    <td>{{$item['end']}}</td>
                                    <td>
                                        @if ($item['tipe'] == 0)
                                            Absen
                                        @else
                                            Istirahat
                                        @endif
                                    </td>
                                    <td style="width: 15%">
                                        <button id="btn-hapus" class="btn btn-danger btn-sm" data-id="{{$item->id}}">Hapus</button>
                                    </td>
                                </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>N0</th>
                                <th>start</th>
                                <th>end</th>
                                <th>tipe</th>
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
                <p class="text-primary"><b>KELAS</b></p>
              </div>
              <form id="formData" class="row g-3" onsubmit="return false">
                @csrf
                <div class="col-12">
                  <input type="hidden" name="id" id="dataId">
                  <label class="form-label w-100" for="modalAddCard">Start</label>
                  <div class="input-group input-group-merge">
                    <input id="start" name="start" class="form-control credit-card-mask" type="time" placeholder="Input disini" required>
                </div>
                <span class="text-danger small" id="alert-start"></span>
                </div>
                <div class="col-12">
                    <label class="form-label w-100" for="modalAddCard">End</label>
                    <div class="input-group input-group-merge">
                        <input id="end" name="end" class="form-control credit-card-mask" type="time" placeholder="Input disini" required>
                    </div>
                    <span class="text-danger small" id="alert-end"></span>
                </div>
                <div class="col-12">
                    <label class="form-label w-100" for="modalAddCard">Tipe</label>
                    <div class="input-group input-group-merge">
                        <select name="tipe" id="tipe" class="form-select">
                            <option value="" selected disabled>-- Pilih --</option>
                            <option value="0">Absen</option>
                            <option value="1">Istirahat</option>
                        </select>
                    </div>
                    <span class="text-danger small" id="alert-tipe"></span>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" id="btn-simpan" class="btn btn-outline-primary mt-3" style="margin-right: 0.5rem">Submit</button>
                    <button type="reset" class="btn btn-outline-danger mt-3" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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
            $('.modal-title' ).html    ("Formulir Tambah Data" );
            $('#btn-simpan'  ).val     ("create-Item"          );
            $('#id'          ).val     (''                     );
            $('#formData'    ).trigger ("reset"                );
            $('#modal-data'  ).modal   ('show'                 );
            $('#alert-start'  ).html   (''                     );
            $('#alert-end'   ).html    (''                     );
            $('#alert-tipe'  ).html    (''                     );
        });

        $('#btn-simpan').click(function (e) {
            e.preventDefault();
            let submitButton = $(this);
            submitButton.html('Simpan');

            if (!submitButton.prop('disabled')) {
                submitButton.prop('disabled', true);
                $.ajax({
                    data    : $('#formData').serialize()    ,
                    url     : `${baseUrl}/api/v1/ketentuan/`,
                    type    : "POST"                        ,
                    dataType: 'json'                        ,
                    success: function(result) {
                        let message = result.message
                        Swal.fire({
                            title            : 'success'                ,
                            text             :  message,
                            icon             : 'success'                ,
                            cancelButtonColor: '#d33'                   ,
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
                                $('#alert-start').html(errorRes.data.start);
                                $('#alert-end').html(errorRes.data.end);
                                $('#alert-tipe').html(errorRes.data.tipe);
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
            let url = `${baseUrl}/api/v1/ketentuan/` + _id;
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