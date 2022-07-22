@extends('adminlte::page')

@section('title', 'Data Kamar')
@section('content_header')
<h1 class="m-0 text-dark">Data Kamar</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body ">
                        <div class="table-responsive">

                            <table class="table table-hover table-bordered table-stripped" id="example2" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kampus</th>
                                        <th>Gedung</th>
                                        <th>Kamar</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kamars as $kamar)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kamar->gedung->kampus }}</td>
                                        <td>{{ $kamar->gedung->gedung }}</td>
                                        <td>{{ $kamar->kamar }}</td>
                                        <td>
                                            <a class="badge bg-info border-0" href="/kamar//edit">
                                                EDIT
                                            </a>
                                            <form action="/kamar/{{$kamar->id}}" method="post" class="d-inline">
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
            <div class=" col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Kamar</h3>
                    </div>
                    <div class="card-body">
                        <form action="/kamar" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="id_gedung">Gedung</label>
                                <select class="custom-select  @error('id_gedung') is-invalid @enderror" id="id_gedung"
                                    name="id_gedung">
                                    <option>- Select Gedung -</option>
                                    <option disabled>----------------- Kampus 1 -----------------</option>
                                    @foreach ($gedungKampus1 as $data )
                                    @if (old('id_gedung') == $data->gedung)
                                    <option value="{{ $data->id }}" selected>{{ $data->gedung }}</option>
                                    @else
                                    <option value="{{ $data->id }}">{{ $data->gedung }}</option>
                                    @endif
                                    @endforeach
                                    <option disabled>----------------- Kampus 2 -----------------</option>
                                    @foreach ($gedungKampus2 as $data )
                                    @if (old('id_gedung') == $data->gedung)
                                    <option value="{{ $data->id }}" selected>{{ $data->gedung }}</option>
                                    @else
                                    <option value="{{ $data->id }}">{{ $data->gedung }}</option>
                                    @endif
                                    @endforeach
                                    <option disabled>----------------- Kampus 3 -----------------</option>
                                    @foreach ($gedungKampus3 as $data )
                                    @if (old('id_gedung') == $data->gedung)
                                    <option value="{{ $data->id }}" selected>{{ $data->gedung }}</option>
                                    @else
                                    <option value="{{ $data->id }}">{{ $data->gedung }}</option>
                                    @endif
                                    @endforeach
                                    <option disabled>----------------- Kampus 4 -----------------</option>
                                    @foreach ($gedungKampus4 as $data )
                                    @if (old('id_gedung') == $data->gedung)
                                    <option value="{{ $data->id }}" selected>{{ $data->gedung }}</option>
                                    @else
                                    <option value="{{ $data->id }}">{{ $data->gedung }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('id_gedung')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="kamar">Kamar</label>
                                <input type="number" class="form-control @error('kamar') is-invalid @enderror "
                                    value="{{ old('kamar') }}" id="kamar" placeholder="kamar" name="kamar">
                                @error('kamar')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
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