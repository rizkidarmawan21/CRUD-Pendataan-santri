@extends('adminlte::page')

@section('title', 'Import Excel')

@section('content_header')
    <h1 class="m-0 text-dark"><a href="/datasantri">DataSantri</a> &raquo; Import Excel</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card ">
                        <!-- form start -->
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Input File Excel</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="excel"
                                                        id="exampleInputFile" required>
                                                    <label class="custom-file-label" for="exampleInputFile"
                                                        name="excel">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Import</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-3 ml-3">
                                    <h3 class="text-bold">CATATAN PENTING !</h3>
                                    <ol type="number">
                                        <li>Download Template Excel <a href="/download">disini</a> </li>
                                        <li>Input data pada kolom yang sudah disediakan</li>
                                        <li>Jenis Kelamin diisi : SANTRIWAN atau SANTRIWATI</li>
                                        <li>Penulisan field kampus : Kampus 1, Kampus 2, Kampus 3, Kampus 4 . Perhatikan
                                            besar kecil huruf!</li>
                                        <li>Setelah berhasil import data,hapus data judul yang ikut masuk kedalam aplikasi
                                            <a target="blank" href="/video-import.mp4">Lihat contoh</a></li>
                                    </ol>
                                    <img src="{{ url('ss-import-example.jpg') }}" class="img-fluid" alt="">
                                </div>
                            </div>
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
        <strong>Application Created with ❤️ By <a target="blank" href="">Darms</a>.</strong>
    </footer>
@stop


@push('js')
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endpush
