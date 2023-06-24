@extends('Skelton.Base')
@section('title')
    Siswa
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt--5" style="float: left">Data Siswa</h4>
                    <button id="createData" type="button" class="btn btn-secondary" style="float: right">Tambah Data</button>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>nama/nip</th>
                                <th>ttl</th>
                                <th>alamat</th>
                                <th>hp</th>
                                <th>Jenis Kelamin</th>
                                <th>agama</th>
                                <th>kelas</th>
                                <th>jurusan</th>
                                <th>rfid</th>
                                <th>foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                          @foreach ($siswa as $item)
                                <tr>
                                    <td style="width: 5%">{{$no++}}</td>
                                    <td>{{$item['nisn']}} <br> {{$item['nama']}}</td>
                                    <td>{{$item['tmpt_lahir']}} <br> {{$item['tgl_lahir']}}</td>
                                    <td>{{$item['alamat']}}</td>
                                    <td>{{$item['hp']}}</td>
                                    <td>{{$item['sex']}}</td>
                                    <td>{{$item['agama']}}</td>
                                    <td>{{$item['kelas']}}</td>
                                    <td>{{$item['jurusan']}}</td>
                                    <td>{{$item['rfid']}}</td>
                                    <td style="width: 10%">
                                        <img src="{{ asset('storage/siswa/' . $item['foto']) }}" style="width: 70%">
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
                                <th>ttl</th>
                                <th>alamat</th>
                                <th>hp</th>
                                <th>Jenis Kelamin</th>
                                <th>agama</th>
                                <th>kelas</th>
                                <th>jurusan</th>
                                <th>rfid</th>
                                <th>foto</th>
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
                <h3>Form Tambah Data</h3>
                <p class="text-primary"><b>SISWA</b></p>
              </div>
              <form id="formData" class="row g-3" onsubmit="return false" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserFirstName">nisn</label>
                  <input type="text" id="nisn" name="nisn" class="form-control" placeholder="Masukan Nisn" />
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserLastName">nama</label>
                  <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama" />
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserFirstName">tmpt lahir</label>
                  <input type="text" id="tmpt_lahir" name="tmpt_lahir" class="form-control" placeholder="Tempat Lahir" />
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserLastName">tgl lahir</label>
                  <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" />
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserFirstName">alamat</label>
                  <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukan Alamat" />
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserLastName">no hp</label>
                  <input type="text" id="hp" name="hp" class="form-control" placeholder="No Handpohone" />
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserStatus">Jenis Kelamin</label>
                  <select id="sex" name="sex" class="form-select" aria-label="Default select example">
                      <option value="Wanita" selected>Perempuan</option>
                      <option value="Pria" selected>Laki-Laki</option>
                  </select>
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserLastName">agama</label>
                  <input type="text" id="agama" name="agama" class="form-control" placeholder="Masukan Agama" />
                  </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserStatus">kelas</label>
                  <select id="kelas_id" name="kelas_id" class="form-select" aria-label="Default select example">
                        <option value="" selected>-- Pilih --</option>
                        @foreach ($kelas as $d)
                        <option value="{{$d->id}}">{{$d->nama_kelas}}</option>
                        @endforeach
                  </select>
                </div>
                <div class="col-12 col-md-6">
                   <label class="form-label" for="modalEditUserStatus">jurusan</label>
                   <select id="jurusan_id" name="jurusan_id" class="form-select" aria-label="Default select example">
                        <option value="" selected>-- Pilih --</option>
                        @foreach ($jurusan as $d)
                        <option value="{{$d->id}}">{{$d->nama_jurusan}}</option>
                        @endforeach
                   </select>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserLastName">rfid</label>
                    <input type="text" id="rfid" name="rfid" class="form-control" placeholder="Contoh: 41564724827562" />
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserFirstName">Foto</label>
                    <input type="file" id="foto" name="foto" class="form-control mb-5" placeholder="Format foto" />
                </div>
                <div class="col-12 text-center">
                  <button type="button" id="btn-simpan" class="btn btn-primary me-sm-3 me-1">Submit</button>
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
            let foto = $('#foto').prop('files')[0]
            $.get("http://127.0.0.1:8000/api/v1/siswa/" + _id, function (res) {
                $('.modal-title').html("Form Edit Data");
                $('#btn-simpan').val("edit-user");
                $('#modal-data').modal('show');
                $('#id').val(res.data.id);
                $('#nisn').val(res.data.nisn);
                $('#nama').val(res.data.nama);
                $('#tmpt_lahir').val(res.data.tmpt_lahir);
                $('#tgl_lahir').val(res.data.tgl_lahir);
                $('#alamat').val(res.data.alamat);
                $('#hp').val(res.data.hp);
                $('#sex').val(res.data.sex);
                $('#agama').val(res.data.agama);
                $('#kelas_id').val(res.data.kelas_id);
                $('#jurusan_id').val(res.data.jurusan_id);
                $('#rfid').val(res.data.rfid);
                $('#foto').val(res.data.foto);
            })
        });

        $('#btn-simpan').click(function (e) {
            e.preventDefault();
            $(this).html('Simpan');
            let submitButton = $(this).prop('disabled')

            if(!submitButton){
                let foto = $('#foto').prop('files')[0]
                let data = new FormData($('#formData')[0]);

                $.ajax({
                    url: "http://127.0.0.1:8000/api/v1/siswa",
                    method: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
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
            let url = "http://127.0.0.1:8000/api/v1/siswa/" + _id;
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
                            console.log(result);
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