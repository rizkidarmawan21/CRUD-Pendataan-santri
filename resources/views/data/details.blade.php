@extends('adminlte::page')

@section('title', 'Detail Santri')
@section('content_header')
<h1 class="m-0 text-dark">Data santri &raquo; Detail &raquo; {{ $data_santri->nama }}</h1>
@stop

@section('content')
<div class="row">
    <div class=" col-lg-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Informasi Detail Santri</h3>
            </div>
            <div class="card-body">
                <table width="100%" class="table table-borderless">
                    <tr>
                        <th width="20%">Nama Santri</th>
                        <td>: {{ $data_santri->nama }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Alamat</th>
                        <td>: {{ $data_santri->alamat }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Wali</th>
                        <td>: {{ $data_santri->nama_ortu }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Telepon</th>
                        <td>: {{ $data_santri->no_telp }} <br> <a href="" class="btn btn-sm btn-success">Chat
                                Whatsapp</a></td>
                    </tr>
                    <tr>
                        <th width="20%">Jenjang</th>
                        <td>: {{ $data_santri->jenjang }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Kelas</th>
                        <td>: {{ $data_santri->kelas}}</td>
                    </tr>
                </table>
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-primary ml-2">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                            href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                            aria-selected="true">Kamar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                            href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                            aria-selected="false">Perizinan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill"
                            href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                            aria-selected="false">Pelanggaran</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel"
                        aria-labelledby="custom-tabs-three-home-tab">
                        <table class="table table-borderless">
                            <tr>
                                <th width="20%">Kampus</th>
                                <td>: {{ $data_santri->detail->kamar->gedung->kampus ?? '-'}}</td>
                            </tr>
                            <tr>
                                <th width="20%">Gedung</th>
                                <td>: {{ $data_santri->detail->kamar->gedung->gedung ?? '-'}}</td>
                            </tr>
                            <tr>
                                <th width="20%">Kamar</th>
                                <td>: {{ $data_santri->detail->kamar->kamar ?? '-'}}</td>
                            </tr>
                        </table>
                        <div class="col-md-12 text-right">
                            @if(!$data_santri->detail)
                            <button type="button" class="btn btn-success ml-2">Masukkan kamar</button>
                            @endif
                            <button type="button" class="btn btn-primary ml-2">Edit</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                        aria-labelledby="custom-tabs-three-profile-tab">
                        <p>Coming Soon</p>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                        aria-labelledby="custom-tabs-three-messages-tab">
                        <p>Coming Soon</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.1
    </div>
    <strong>Application Created with ❤️ By <a target="blank" href="http://rizkidarmawan21.github.io">Darms</a>.</strong>
</footer>
@stop




@push('js')
<script>
    $(function () {
        $('#example2').DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
    });
</script>
@endpush