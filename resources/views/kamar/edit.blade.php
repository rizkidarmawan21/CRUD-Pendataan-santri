@extends('adminlte::page')

@section('title', 'Edit Kamar Santri')
@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Santri dan Kamar </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('detail.santri.update', $data->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Kamar</label>
                            <select class="form-control select2" style="width: 100%;" name="id_kamar">
                                <option value="" selected>Pilih Kamar</option>
                                @foreach ($masterKamar as $gedung)
                                    <option disabled>G. {{ $gedung->gedung }}</option>
                                    @foreach ($gedung->kamar as $kamar)
                                        @if ($kamar->id == $data->id_kamar)
                                            <option value="{{ $kamar->id }}" selected>
                                                {{ $gedung->kampus }} - {{ $gedung->gedung }} - {{ $kamar->kamar }}
                                            </option>
                                        @else
                                            <option value="{{ $kamar->id }}">
                                                {{ $gedung->kampus }} - {{ $gedung->gedung }} - {{ $kamar->kamar }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Santri</label>
                            <select class="form-control select2" style="width: 100%;" name="id_santri">
                                <option value="">--Pilih Santri--</option>
                                @foreach ($masterSantri as $mSantri)
                                    @if ($mSantri->id == $data->id_santri)
                                        <option selected value="{{ $mSantri->id }}">{{ $mSantri->nama }} -
                                            {{ $mSantri->jenjang }} {{ $mSantri->kelas }}</option>
                                    @else
                                        <option value="{{ $mSantri->id }}">{{ $mSantri->nama }} -
                                            {{ $mSantri->jenjang }} {{ $mSantri->kelas }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.1
        </div>
        <strong>Application Created with ❤️ By <a target="blank" href="">Darms</a>.</strong>
    </footer>
@stop


@push('js')
    <script>
        $('.select2').select2()

        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
