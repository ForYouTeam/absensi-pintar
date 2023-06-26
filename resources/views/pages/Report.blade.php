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
                <div class="card-body" id="app">
                    <exportfunction/>
                   
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ mix('js/app.js') }}"></script>
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