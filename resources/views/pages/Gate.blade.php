@extends('skelton.Base')
@section('title')
    Gate
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt--5" style="float: left">Data Gate</h4>
                    <button id="createData" type="button" class="btn btn-primary" style="float: right">Tambah Data</button>
                </div>
                <div class="card-body">
                    <table id="table-data" class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>section</th>
                                <th>kelas</th>
                                <th>guru</th>
                                <th>mapel</th>
                                <th>tgl</th>
                                <th>status</th>
                                <th>open</th>
                                <th>close</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data['gate'] as $d)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$d['section']}}</td>
                                    <td>{{$d['kelas']}}</td>
                                    <td>{{$d['guru']}}</td>
                                    <td>{{$d['mapel']}}</td>
                                    <td>{{$d['tgl']}}</td>
                                    <td>{{$d['status']}}</td>
                                    <td>{{$d['open']}}</td>
                                    <td>
                                        @if ($d['close'] == null)
                                            Belum Tutup
                                        @else
                                            {{$d['close']}}
                                        @endif
                                    </td>
                                    <td>
                                        <button class="editItem btn btn-danger btn-sm" type="button">Tutup</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>N0</th>
                                <th>section</th>
                                <th>kelas</th>
                                <th>guru</th>
                                <th>mapel</th>
                                <th>tgl</th>
                                <th>status</th>
                                <th>open</th>
                                <th>close</th>
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
                <p class="text-primary"><b>GATE</b></p>
              </div>
              <form id="formData" class="row g-3">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="col-12 col-md-12">
                    <label class="form-label" for="modalEditUserStatus">rfid</label>
                    <input type="text" id="rfid" name="rfid" class="form-control" placeholder="Masukan RFID" autofocus/>
                    <span class="text-danger error-msg small" id="alert-sex"></span>
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserFirstName">kelas</label>
                    <select id="kelas_id" name="kelas_id" class="form-select" aria-label="Default select example">
                        <option value="" selected>-- Pilih --</option>
                        @foreach ($data['kelas'] as $d)
                        <option value="{{$d->id}}">{{$d->nama_kelas}}</option>
                        @endforeach
                    </select>
                  <span class="text-danger error-msg small" id="alert-nip"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserLastName">mapel</label>
                    <input type="text" id="mapel" name="mapel" class="form-control" placeholder="Masukan mata pelajaran"/>
                    <span class="text-danger error-msg small" id="alert-nama"></span>
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
@endsection
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
        $('.modal-title' ).html    ("Form Tambah Data");
        $('#btn-simpan'  ).val     ("create-Item"     );
        $('#id'          ).val     (''                );
        $('#rfid'        ).focus   (                  );
        $('#formData'    ).trigger ("reset"           );
        $('#modal-data'  ).modal   ('show'            );
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
        })
    });

    $('#btn-simpan').click(function (e) {
            e.preventDefault();
            let submitButton = $(this);
            submitButton.html('Simpan');
            let data = $('#formData').serialize() 

            if (!submitButton.prop('disabled')) {
                submitButton.prop('disabled', true);
                $.ajax({
                    data    :  data,
                    url     : `${BaseUrl}/api/v1/gate/open`,
                    type    : "POST"                      ,
                    dataType: 'json'                      ,
                    success: function(result) {
                        Swal.fire({
                            title            : 'Success',
                            text             : 'Data Berhasil diproses',
                            icon             : 'success',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Oke'
                        }).then((result) => {
                            location.reload();
                        });
                        $('#modal-data').modal('hide');
                    },
                    error: function(result) {
                        console.log(result);
                        submitButton.prop('disabled', false);
                        if (result.status = 422) {
                            let data = result.responseJSON
                            let errorRes = data.errors;
                            if (errorRes.length >= 1) {
                                $('#alert-rfid').html(errorRes.data.rfid);
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