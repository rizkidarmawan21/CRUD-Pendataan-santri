@extends('adminlte::page')

@section('title', 'Perizinan Santri')
@section('content_header')
    <h1 class="m-0 text-dark">
        Perizinan Santri
        {{ dataPerizinan(Auth::user()->is_admin) }}
        @if (isset($_GET['filter']) && $_GET['filter'] == 'not-verify')
            <small style="font-size: 13px" class=" badge badge-pill badge-info">Not Verify</small>
        @elseif(isset($_GET['filter']) && $_GET['filter'] == 'verify')
            <small style="font-size: 13px" class=" badge badge-pill badge-info">Masa Izin</small>
        @elseif(isset($_GET['filter']) && $_GET['filter'] == 'back')
            <small style="font-size: 13px" class=" badge badge-pill badge-info">Sudah Kembali</small>
        @endif
    </h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <button type="submit" data-toggle="modal" data-target="#exampleModal"
                            class="mb-2 btn btn-sm btn-primary">Tambah
                            Perizinan
                            Santri</button>
                        <a href="{{ route('perizinan.index') }}" class="btn btn-sm mb-2 btn-info">All</a>
                        <a href="{{ route('perizinan.index', ['filter' => 'not-verify']) }}"
                            class="btn btn-sm mb-2 btn-danger">Not Verify</a>
                        <a href="{{ route('perizinan.index', ['filter' => 'verify']) }}" class="btn btn-warning btn-sm mb-2">
                            Masa Izin
                        </a>
                        <a href="{{ route('perizinan.index', ['filter' => 'back']) }}" class="btn btn-success btn-sm mb-2">
                            Sudah Kembali
                        </a>
                    </div>

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered table-stripped" id="example2" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Kamar</th>
                                    <th>Kelas</th>
                                    <th>Izin</th>
                                    <th>Tanggal Izin</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perizinan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->santri->nama }}</td>
                                        <td>{{ $item->santri->detail->kamar->gedung->kampus }}
                                            {{ $item->santri->detail->kamar->gedung->gedung }}
                                            {{ $item->santri->detail->kamar->kamar }}</td>
                                        <td>{{ $item->santri->jenjang }} {{ $item->santri->kelas }}</td>
                                        <td><span
                                                class="badge badge-secondary badge-pill">{{ $item->nama_perizinan }}</span>
                                            -
                                            {{ $item->keterangan }}</td>
                                        <td>{{ date('d F Y', strtotime($item->tanggal_perizinan)) }}</td>
                                        <td>{{ date('d F Y', strtotime($item->tanggal_kembali)) }}</td>
                                        <td>

                                            @if ($item->status == 0)
                                                <span class="badge badge-pill badge-danger text-white">Not Verify</span>
                                            @elseif ($item->status == 1)
                                                @if (date('Y-m-d') > $item->tanggal_kembali)
                                                    <span class="badge badge-pill badge-warning ">Verify -
                                                        <span class="text-danger">Terlambat</span>
                                                    </span>
                                                    <br>
                                                    <a target="blank"
                                                        href="https://api.whatsapp.com/send?phone={{ convertNumber($item->santri->no_telp) }}&text=Assalamualaikum%20%0A%0AKami%20dari%20ponpes%20Askhabul%20Kahfi%20menginformasikan%20bahwa%20putra%20%2F%20putri%20bapak%20%2F%20ibu%20atas%20nama%20{{ $item->santri->nama }}%20%2C%20telah%20terlambat%20kembali%20ke%20pondok%20pesantren%20%2C%20mohon%20kepada%20bapak%20%2F%20ibu%20wali%20santri%20untuk%20bisa%20mengantarkan%20putra%20%2F%20putri%20nya%20ke%20pesantren%20demi%20mentaati%20peraturan%20pondok%20pesantren%20Askhabul%20Kahfi%20%2C%20jika%20terlambat%20datang%20ke%20pesantren%20maka%20akan%20di%20kenai%20sanksi%20kecuali%20ada%20konfirmasi%20perpanjangan%20izin%20%2C%20yg%20bisa%20di%20kirimkan%20ke%20nomor%20kantor%20kampus%20masing2%20terima%20kasih%20%0A%0AWassalamualaikum"
                                                        class="badge badge-pill badge-success">Kirim WA</a>
                                                @else
                                                    <span class="badge badge-pill badge-warning ">Verify -
                                                        Masa Izin
                                                    </span>
                                                @endif
                                            @else
                                                <span class="badge badge-pill badge-success">Sudah Kembali</span>
                                            @endif

                                        </td>
                                        <td>
                                            @if ($item->status == 0)
                                                @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 0)
                                                    <form method="POST"
                                                        action="{{ route('perizinan.verify', $item->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="badge badge-pill badge-warning border-0">
                                                            Verify
                                                        </button>
                                                    </form>
                                                @endif
                                                <a target="blank" href="{{ route('perizinan.surekom', $item->id) }}"
                                                    target="blank" class="badge badge-pill badge-success">
                                                    Surat Pengantar
                                                </a>
                                            @elseif($item->status == 1)
                                                @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 0)
                                                    <a target="blank" href="{{ route('perizinan.suizin', $item->id) }}"
                                                        target="blank" class="badge badge-pill badge-warning">
                                                        Surat Izin
                                                    </a>
                                                @endif
                                                <form action="{{ route('perizinan.back', $item->id) }}" method="post">
                                                    @csrf
                                                    <button class="badge badge-success badge-pill border-0">
                                                        Kembali
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('perizinan.show', $item->id) }}"
                                                class="badge badge-pill bg-info" href="">Detail</a>
                                            <form action="{{ route('perizinan.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="badge badge-danger badge-pill border-0">
                                                    Delete
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

    {{-- {{ dd($masterSantri) }} --}}

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ploting Kamar Santri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('perizinan.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Santri</label>
                                    <select class="form-control select2" data-placeholder="Pilih Santri"
                                        style="width: 100%;" name="id_santri" required>
                                        <option value="" selected disabled>Pilih santri</option>
                                        @foreach ($masterSantri as $mSantri)
                                            <option value="{{ $mSantri->santri->id }}">{{ $mSantri->santri->kampus }} -
                                                {{ $mSantri->santri->nama }} - {{ $mSantri->santri->jenjang }}
                                                {{ $mSantri->santri->kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Perizinan</label>
                                    <select name="nama_perizinan" id="nama_perizinan" class="form-control" required>
                                        <option value="" disabled selected>Pilih perizinan</option>
                                        <option value="IZIN PULANG">IZIN PULANG</option>
                                        <option value="IZIN KELUAR" disabled>IZIN KELUAR (Maintenance)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control" id="" cols="10" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Kembali</label>
                                    <input required type="date" name="tanggal_kembali" id=""
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@stop




@push('js')
    <script>
        $(function() {
            $('#example2').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        $('.select2').select2()
    </script>
@endpush
