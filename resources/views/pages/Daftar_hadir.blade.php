@extends('skelton.Base')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt--5" style="float: left">Data Absensi</h4>
                    <button id="createData" type="button" class="btn btn-secondary" style="float: right">Tambah Data</button>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>    
                </div>
            </div>
        </div>
    </div>
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
            console.log($('#formData').serialize());
            e.preventDefault();
            $(this).html('Mengirim...');
            let submitButton = $(this).prop('disabled')

            if(!submitButton){
                $(this).prop('disabled', true);
                $.ajax({
                    data: $('#formData').serialize(),
                    url: "http://127.0.0.1:8000/api/v1/guru",
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
                                text: data.message,
                            });
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
                                text: result.message,
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