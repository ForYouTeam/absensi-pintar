@extends('skelton.Base')
@section('title')
    Mata Pelajaran
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt--5" style="float: left">Data Mata Pelajaran</h4>
                    <button id="createData" type="button" class="btn btn-secondary" style="float: right">Tambah Data</button>
                </div>
                <div class="card-body">
                    <table id="table-data" class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Mata Pelajaran</th>
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
                                    <td style="width: 60%">{{ $item['nama_mapel'] }}</td>
                                    <td>
                                        <button class="editItem btn btn-info btn-sm" data-id="{{$item->id}}">Edit</button>
                                        <button id="btn-hapus" class="btn btn-danger btn-sm" data-id="{{$item->id}}">Hapus</button>
                                    </td>
                                </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>N0</th>
                                <th>Mata Pelajaran</th>
                                <th>Acntion</th>
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
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="text-center mb-4">
                <h3 id="#modalheader" class="modal-title"></h3>
                <p class="text-primary"><b>MATA PELAJARAN</b></p>
              </div>
              <form id="formData" class="row g-3" onsubmit="return false">
                @csrf
                <div class="col-12">
                  <label class="form-label w-100" for="modalAddCard">Nama Mapel</label>
                  <div class="input-group input-group-merge">
                    <input type="hidden" name="id" id="dataId">
                    <input id="nama_mapel" name="nama_mapel" class="nama_mapel form-control credit-card-mask" type="text" placeholder="Masukan Mapel" required>
                    <span class="text-danger" id="nama-alert"></span>
                  </div>
                </div>
                <div class="col-12 text-center">
                  <button type="submit" id="btn-simpan" class="btn btn-primary me-sm-3 me-1 mt-3">Submit</button>
                  <button type="reset" class="btn btn-label-secondary btn-reset mt-3" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    {{-- End Modal --}}
    @section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#table-data').DataTable();
        });

        $('#createData').click(function () {
            $('.modal-title').html("Form Tambah Data");
            $('#btn-simpan').val("create-Item");
            $('#id').val('');
            $('#formData').trigger("reset");
            $('#modal-data').modal('show');
        });

        $('body').on('click', '.editItem', function () {
            var _id = $(this).data('id');
            $.get("http://127.0.0.1:8000/api/v1/mapel/" + _id, function (res) {
                $('.modal-title').html("Form Edit Data");
                $('#btn-simpan').val("edit-user");
                $('#modal-data').modal('show');
                $('#nama_mapel').val(res.data.nama_mapel);
                $('#dataId').val(res.data.id);
                console.log(res);
            })
        });

        $('#btn-simpan').click(function (e) {
            e.preventDefault();
            $(this).html('Simpan');
            let submitButton = $(this).prop('disabled')

            if(!submitButton){
                $(this).prop('disabled', true);
                $.ajax({
                    data: $('#formData').serialize(),
                    url: "http://127.0.0.1:8000/api/v1/mapel",
                    type: "POST",
                    dataType: 'json',
                        success: function(result) {
                            Swal.fire({
                                title: 'Success',
                                text: result.message,
                                icon: 'success',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Oke'
                            }).then((result) => {
                                location.reload();
                            });
                            $('#modal-data').modal('hide');
                        },
                        error: function(result) {
                            $('#btn-simpan').prop('disabled', false);
                            let data = result.responseJSON
                            let errorRes = data.errors
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Silahkan periksa inputan anda..!',
                            });
                            $('#modal-data').modal('hide');
                            if (errorRes.length >= 1) {
                                $('#nama-alert').html(errorRes.data.nama_mapel);
                            }
                        }
                });
            }
        });

        $(document).on('click', '#btn-hapus', function() {
            let _id = $(this).data('id');
            let url = "http://127.0.0.1:8000/api/v1/mapel/" + _id;
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data ini mungkin terhubung ke tabel yang lain!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus'
            }).then((res) => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'delete',
                        success: function(result) {
                            let data = result.data;
                            Swal.fire({
                                title: 'Success',
                                text: 'Data Berhasil Dihapus.',
                                icon: 'success',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Oke'
                            }).then((result) => {
                                location.reload();
                            });
                        },
                        error: function(result) {
                            let data = result.responseJSON
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.response.message,
                            });
                        }
                    });
                }
            })
        });
    </script>
@endsection
@endsection