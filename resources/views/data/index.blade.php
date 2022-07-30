@extends('adminlte::page')

@section('title', 'Data Santri')
@section('content_header')
<h1 class="m-0 text-dark">Data Santri</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{route('datasantri.create')}}" class="btn btn-primary mb-2">
                    Tambah
                </a>
                <a href="/import" class="btn btn-warning mb-2">
                    Import Ecxel
                </a>
                <a href="/exportexcel" onclick="return confirm('Are You Sure To Export ?')"
                    class="btn btn-secondary mb-2">
                    Export Ecxel
                </a>

                <div class="table-responsive">

                    <table class="table table-hover table-bordered table-stripped" id="example2" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kampus</th>
                                <th>Nama</th>
                                <th>Jenkel</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Wali</th>
                                <th>Kelas</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody @foreach($data_santris as $key=> $data)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$data->kampus}}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->jenkel}}</td>
                                <td>{{$data->alamat}}</td>
                                <td>{{ convertNumber($data->no_telp) }}</td>
                                <td>{{$data->nama_ortu}}</td>
                                <td>{{$data->jenjang}} {{$data->kelas}}</td>
                                <td>
                                    <a class="badge bg-info border-0" href="/datasantri/{{ $data->id }}">
                                        Detail
                                    </a>
                                    <a class="badge bg-warning border-0" href="/datasantri/{{ $data->id }}/edit">
                                        EDIT
                                    </a>
                                    <form action="/datasantri/{{  $data->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('ARE YOU SURE ?')">
                                            DELETE
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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