@extends('adminlte::page')

@section('title', 'Input Data Santri')
@section('content_header')
    <h1 class="m-0 text-dark"><a href="/datasantri">Data Santri</a> &raquo; Input</h1>
@stop

@section('content')

    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Input</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="/datasantri/{{ $data->id }}">
            @method('put')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group ">
                            <label for="nama">Nama Santri</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror "
                                value="{{ old('nama', $data->nama) }}" id="nama" placeholder="Nama santri"
                                name="nama">
                            @error('nama')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" value="{{ old('alamat', $data->alamat) }}"
                                class="form-control @error('alamat')
                            is-invalid
                          @enderror"
                                id="alamat" placeholder="Alamat santri" name="alamat">
                            @error('alamat')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No Telepon</label>
                            <input type="text" value="{{ old('no_telp', $data->no_telp) }}"
                                class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
                                placeholder="No Telepon santri" name="no_telp">
                            @error('no_telp')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_ortu">Nama Wali</label>
                            <input type="text" class="form-control @error('nama_ortu') is-invalid @enderror"
                                value="{{ old('nama_ortu', $data->nama_ortu) }}" id="nama_ortu" placeholder="Nama Wali"
                                name="nama_ortu">
                            @error('nama_ortu')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenkel">Jenis Kelamin</label>
                            <select class="custom-select @error('jenkel') is-invalid @enderror" id="jenkel"
                                name="jenkel" required>
                                <option value="{{ $data->jenkel }}">{{ $data->jenkel }}</option>
                                <option value="SANTRIWAN">SANTRIWAN</option>
                                <option value="SANTRIWATI">SANTRIWATI</option>
                            </select>
                            @error('jenkel')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenjang">Jenjang</label>
                            <select class="custom-select @error('jenjang') is-invalid @enderror" id="jenjang"
                                name="jenjang" required>
                                <option value="{{ $data->jenjang }}">{{ $data->jenjang }}</option>
                                <option value="SMP 1">SMP 1</option>
                                <option value="SMP 2">SMP 2</option>
                                <option value="SMK">SMK</option>
                                <option value="MTS">MTS</option>
                                <option value="MA">MA</option>
                            </select>
                            @error('jenjang')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" value="{{ old('kelas', $data->kelas) }}"
                                class="form-control  @error('kelas') is-invalid @enderror" id="kelas"
                                placeholder="Kelas" name="kelas">
                            <small class="form-text text-muted">
                                Ex : 7D ,12 TKJ , 11 IPA
                            </small>
                            @error('kelas')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
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

                        <ul>
                            <li>
                                <p>Isikan " - " jika data diisi kosong</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->

    <!-- general form elements -->


    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.1
        </div>
        <strong>Application Created with ❤️ By <a target="blank" href="">Darms</a>.</strong>
    </footer>
@stop
