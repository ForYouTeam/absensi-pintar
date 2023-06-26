@extends('skelton.Base')
@section('title')
    Mata Pelajaran
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt--5" style="float: left">Report Data</h4>
                    {{-- <button id="createData" type="button" class="btn btn-primary" style="float: right">Tambah Data</button> --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group text-center">
                                <div class="form-lable mb-3">Data Kehadiran</div>
                                <button class="btn btn-primary btn-lg">DOWNLOAD REPORT</button>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group text-center">
                                <div class="form-lable mb-3">Data Siswa</div>
                                <button class="btn btn-primary btn-lg">DOWNLOAD REPORT</button>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group text-center">
                                <div class="form-lable mb-3">Data Guru</div>
                                <button class="btn btn-primary btn-lg">DOWNLOAD REPORT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/export.js')}}"></script>
    <script>
        let baseUrl

        $(document).ready(function() {
            baseUrl = "{{ config('app.url') }}"

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection