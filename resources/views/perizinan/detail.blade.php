@extends('adminlte::page')

@section('title', 'Detail Perizinan Santri')
@section('content_header')
<h1 class="m-0 text-dark">Detail Perizinan</h1>
@stop

@section('content')

{{-- {{ dd($perizinan) }} --}}
<div class="row">
    <div class=" col-lg-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Informasi Detail Perizinan Santri</h3>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                <table width="100%" class="table table-bordered" style="overflow-x: scroll;">
                    <tr>
                        <th width="20%">Nama Santri</th>
                        <td>: {{ $perizinan->santri->nama }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Jenis Kelamin</th>
                        <td>: {{ $perizinan->santri->jenkel }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Alamat</th>
                        <td>: {{ $perizinan->santri->alamat }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Wali</th>
                        <td>: {{ $perizinan->santri->nama_ortu }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Telepon</th>
                        <td>: {{ $perizinan->santri->no_telp }} <br> <a href="" class="btn btn-sm btn-success">Chat
                                Whatsapp</a></td>
                    </tr>
                    <tr>
                        <th width="20%">Jenjang</th>
                        <td>: {{ $perizinan->santri->jenjang }} - {{ $perizinan->santri->kelas }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Kamar</th>
                        <td>: {{ $perizinan->santri->detail->kamar->gedung->kampus }} - {{
                            $perizinan->santri->detail->kamar->gedung->gedung }} {{
                            $perizinan->santri->detail->kamar->kamar }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h5>Histori Izin</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Izin</th>
                                        <th scope="col">Keperluan</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($historyIzin as $history)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration}}</th>
                                        <td>
                                            <table class="table table-bordered" border="1">
                                                <tr>
                                                    <th>Izin</th>
                                                    <th>Kembali</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $history->tanggal_perizinan }}</td>
                                                    <td>{{ $history->tanggal_kembali }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>{{ $history->nama_perizinan }}</td>
                                        <td>{{ $history->keterangan }}</td>
                                        <td>
                                            @if($history->status == 0)
                                            <span class="badge badge-pill badge-danger text-white">Not Verify</span>
                                            @elseif($history->status == 1)
                                            <span class="badge badge-pill badge-warning">
                                                Verify-
                                                @if(date(('Y-m-d')) > $history->tanggal_kembali)
                                                <span class="text-danger">Terlambat</span>
                                                @else
                                                Masa Izin
                                                @endif
                                            </span>
                                            @else
                                            <span class="badge badge-pill badge-success">Sudah Kembali</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">Santri Belum Pernah Melakukan Izin</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
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
                            aria-selected="true">Edit Perizinan</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel"
                        aria-labelledby="custom-tabs-three-home-tab">
                        <form action="{{ route('perizinan.update',$perizinan->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Santri</label>
                                        <select class="form-control select2" data-placeholder="Pilih Santri"
                                            style="width: 100%;" name="id_santri" required>
                                            <option value="{{ $perizinan->santri->id }}" selected>{{
                                                $perizinan->santri->nama }} - {{ $perizinan->santri->jenjang }} {{
                                                $perizinan->santri->kelas }}</option>
                                            @foreach($masterSantri as $mSantri)
                                            <option value="{{ $mSantri->santri->id }}">{{ $mSantri->santri->nama }} - {{
                                                $mSantri->santri->jenjang }} {{
                                                $mSantri->santri->kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Perizinan</label>
                                        <select name="nama_perizinan" id="nama_perizinan" class="form-control" required>
                                            <option value="{{ $perizinan->nama_perizinan }}" selected>{{
                                                $perizinan->nama_perizinan }}</option>
                                            <option value="IZIN PULANG">IZIN PULANG</option>
                                            <option value="IZIN KELUAR">IZIN KELUAR</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control" id="" cols="10" rows="3"
                                            required>{{ $perizinan->keterangan}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Kembali</label>
                                        <input required type="date" name="tanggal_kembali"
                                            value="{{ $perizinan->tanggal_kembali }}" class="form-control">
                                    </div>
                                    <button class="btn btn-sm btn-primary" type="submit">Edit</button>
                                </div>
                            </div>
                            <form />
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