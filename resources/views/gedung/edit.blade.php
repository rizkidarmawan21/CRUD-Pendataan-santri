@extends('adminlte::page')

@section('title', 'Edit Gedung')
@section('content_header')
<h1 class="m-0 text-dark"><a href="/gedung">Data Gedung</a> &raquo; Edit</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class=" col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Gedung</h3>
                    </div>
                    <div class="card-body">
                        <form action="/gedung/{{ $data->id }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="kampus">Kampus</label>
                                <select class="custom-select @error('kampus') is-invalid @enderror" id="kampus"
                                    name="kampus" required>
                                    <option value="{{ $data->kampus }}">{{ $data->kampus }}</option>
                                    @if (old('kampus') == 'Kampus 1')
                                    <option value="Kampus 1" selected>Kampus 1</option>
                                    @elseif (old('kampus') == 'Kampus 2')
                                    <option value="Kampus 2" selected>Kampus 2</option>
                                    @elseif (old('kampus') == 'Kampus 3')
                                    <option value="Kampus 3" selected>Kampus 3</option>
                                    @elseif (old('kampus') == 'Kampus 4')
                                    <option value="Kampus 4" selected>Kampus 4</option>
                                    @else
                                    <option value="Kampus 1">Kampus 1</option>
                                    <option value="Kampus 2">Kampus 2</option>
                                    <option value="Kampus 3">Kampus 3</option>
                                    <option value="Kampus 4">Kampus 4</option>
                                    @endif
                                </select>
                                @error('kampus')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="gedung">Gedung </label>
                                <input type="text" class="form-control @error('gedung') is-invalid @enderror "
                                    value="{{ old('gedung',$data->gedung) }}" id="gedung" placeholder="Gedung"
                                    name="gedung">
                                @error('gedung')
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