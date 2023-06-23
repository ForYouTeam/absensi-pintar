@extends('Skelton.Base')
@section('title')
    Guru
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt--5" style="float: left">Data Guru</h4>
                    <button id="createData" type="button" class="btn btn-secondary" style="float: right">Tambah Data</button>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered" >
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
                        <tbody>
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
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserLastName">nama</label>
                  <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama" />
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserStatus">Jenis Kelamin</label>
                    <select id="sex" name="sex" class="form-select" aria-label="Default select example">
                        <option value="Wanita" selected>Perempuan</option>
                        <option value="Pria" selected>Laki-Laki</option>
                    </select>
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserFirstName">Agama</label>
                  <input type="text" id="agama" name="agama" class="form-control" placeholder="Masukan Agama" />
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserLastName">Status</label>
                  <input type="text" id="status" name="status" class="form-control" placeholder="Status" />
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserFirstName">golongan</label>
                  <input type="text" id="golongan" name="golongan" class="form-control" placeholder="Masukan Golongan" />
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserStatus">Jabatan</label>
                  <select id="jabatan_id" name="jabatan_id" class="form-select" aria-label="Default select example">
                        <option value="" selected>-- Pilih --</option>
                        @foreach ($jabatan as $d)
                        <option value="{{$d->id}}">{{$d->nama_jabatan}}</option>
                        @endforeach
                  </select>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserStatus">mapel</label>
                    <select id="mapel_id" name="mapel_id" class="form-select" aria-label="Default select example">
                          <option value="" selected>-- Pilih --</option>
                          @foreach ($mapel as $d)
                          <option value="{{$d->id}}">{{$d->nama_mapel}}</option>
                          @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label" for="modalEditUserFirstName">Foto</label>
                    <input type="file" id="foto" name="foto" class="form-control mb-5" placeholder="Masukan Golongan" />
                </div>
                <div class="col-12 text-center">
                  <button type="button" id="btn-simpan" class="btn btn-label-primary me-sm-3 me-1">Submit</button>
                  <button type="reset" class="btn btn-label-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
{{-- End Modal --}}

    @section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#example').DataTable();
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
            $.get("http://127.0.0.1:8000/api/v1/guru/" + _id, function (res) {
                $('.modal-title').html("Form Edit Data");
                $('#btn-simpan').val("edit-user");
                $('#modal-data').modal('show');
                $('#id').val(res.data.id);
                $('#nip').val(res.data.nip);
                $('#nama').val(res.data.nama);
                $('#sex').val(res.data.sex);
                $('#agama').val(res.data.agama);
                $('#alamat').val(res.data.alamat);
                $('#status').val(res.data.status);
                $('#golongan').val(res.data.golongan);
                $('#jabatan_id').val(res.data.jabatan_id);
                $('#mapel_id').val(res.data.mapel_id);
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
                    url: "http://127.0.0.1:8000/api/v1/guru",
                    method: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
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
                        // $('#btn-simpan').prop('disabled', false);
                        let data = result.responseJSON
                        let errorRes = data.errors
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Silahkan periksa kemabli inputan anda...!',

                        });
                        $('#modal-data').modal('hide');
                        if (errorRes.length >= 1) {
                            $('#nama-alert').html(errorRes.data.nama_jabatan);
                        }
                    }
                });
            }
        });

        $(document).on('click', '#btn-hapus', function() {
            let _id = $(this).data('id');
            let url = "http://127.0.0.1:8000/api/v1/guru/" + _id;
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